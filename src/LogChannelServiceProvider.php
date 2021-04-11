<?php

namespace NotificationChannels\LogChannel;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

/**
 * Class LogChannelServiceProvider
 * @package NotificationChannels\SmsGate
 */
class LogChannelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(ChannelManager::class, function ($channelManager, $app) {
            $channelManager->extend('log', function($app){
                return $app[LogChannel::class];
            });
        });
    }
}