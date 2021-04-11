<?php

namespace NotificationChannels\LogChannel;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class LogChannel
 * @package NotificationChannels\LogChannel
 */
class LogChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification): void
    {
        if (! ($to = $this->getRecipients($notifiable, $notification))) {
            return;
        }

        $message = $notification->{'toLog'}($notifiable);

        if (\is_string($message)) {
            $message = new LogMessage($message);
        }

        $this->sendMessage($to, $message);
    }

    /**
     * Gets a list of phones from the given notifiable.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     *
     * @return string[]
     */
    protected function getRecipients($notifiable, Notification $notification): array
    {
        $recipients = $notifiable->routeNotificationFor('log', $notification);

        if (empty($recipients)) {
            $recipients = [];
        }

        return is_array($recipients) ? $recipients : [$recipients];
    }

    /**
     * @param $recipients
     * @param LogMessage $message
     */
    protected function sendMessage($recipients, LogMessage $message): void
    {
        $context = array_merge(
            [
                'recipients' => $recipients,
                'content' => $message->content,
            ],
            $message->extra
        );
        Log::channel($message->channel)->debug('Send notification', $context);
    }
}