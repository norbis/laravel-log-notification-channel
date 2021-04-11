<?php

namespace NotificationChannels\LogChannel;

/**
 * Class LogMessage
 * @package NotificationChannels\LogChannel
 */
class LogMessage
{
    /**
     * Текст сообщения
     * @var string
     */
    public $content = '';

    /**
     * Канал лога для отправки
     * @var string
     */
    public $channel = '';

    /**
     * Дополнительные данные
     * @var array
     */
    public $extra = [];

    /**
     * Создает экземпляр нового сообщения
     * @param string $content
     * @param string $channel
     * @param array $extra
     * @return static
     */
    public static function create(string $content = '', string $channel = '', array $extra = []): self
    {
        return new static($content, $channel, $extra);
    }

    /**
     * LogMessage constructor.
     * @param string $content
     * @param string $channel
     * @param array $extra
     */
    public function __construct(string $content = '', string $channel = '', array $extra = [])
    {
        if (!$channel){
            $channel = config('services.logchannel.channel');
        }
        $this->channel = $channel;
        $this->content = $content;
        $this->extra = $extra;
    }

    /**
     * Устанавливает текст сообщения
     * @param  string  $content
     * @return $this
     */
    public function content(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Устанавливает канал лога сообщения
     * @param string $channel
     * @return $this
     */
    public function channel(string $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Устанавливает дополнительные данные сообщения
     * @param array $extra
     * @return $this
     */
    public function extra(array $extra): self
    {
        $this->extra = $extra;
        return $this;
    }
}