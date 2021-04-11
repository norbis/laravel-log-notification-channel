# Log Notifications Channel for Laravel 7+

Компонент для отправки уведомлений в лог для Laravel 7+.

## Contents

- [Установка](#установка)
    - [Настройка сервиса](#настройка-сервиса)
- [Использование](#использование)
    - [Доступные методы для модели сообщения](#доступные-методы-для-модели-сообщения)
- [Изменения](#изменения)
- [Тестирование](#тестирование)

## Установка

Установите библиотеку с помощью Composer
```shell
composer require norbis/laravel-log-notification-channel
```

Сервис провайдер загрузится автоматически или вы можете его добавить вручную:
```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\LogChannel\LogChannelServiceProvider::class,
],
```

### Настройка сервиса

Добавьте канал лога для уведомлений по-умолчанию в ваш `config/services.php`:

```php
// config/services.php
...
/* Настройки */
'logchannel' => [
    /* Канал лога уведомлений по-умолчанию */
    'channel' => 'daily',
],
...
```

## Использование

Вы можете использовать канал в вашем `via()` методе внутри уведомления:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\LogChannel\LogMessage;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return ['log'];
    }

    public function toLog($notifiable)
    {
        return LogMessage::create("Task #{$notifiable->id} is complete!");
    }
}
```

Добавьте метод `routeNotificationForLog()` в вашей модели получателя уведомлений, который будет возвращать
контакт или массив контактов.

```php
public function routeNotificationForLog()
{
    return $this->phone;
}
```

### Доступные методы для модели сообщения

`channel()`: Устанавливает канал лога сообщения.

`content()`: Устанавливает содержимое сообщения.

`extra()`: Устанавливает дополнительные данные для сообщения.

## Изменения

Смотрите [Изменения](CHANGELOG.md) для получения информации по изменениям.

## Тестирование

``` bash
$ composer test
```