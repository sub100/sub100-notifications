# Sub100 Notifications SDK

This package uses Sub100 notification api to send email, sms and whatsapp notifications.

### Usage as a composer package in your Laravel project

Install via composer
```sh
composer req sub100/notifications
```

Publish config
```sh
php artisan vendor:publish --provider="sub100\Notifications\Sub100NotificationServiceProvider"
```

Configure `.env` file
```dotenv
NOTIFICATION_URL=https://path-to-notification/api/
```

```php
<?php

$message = new Message();
$message->subject = 'Subject';
$message->message = 'Message text';
$message->addEmail('test@example.com.br');

Notification::notify($message);

```

### Usage in another projects

Install via composer
```sh
composer req sub100/notifications
```

```php
<?php

$message = new Message();
$message->message = 'Message text';
$message->addWhatsapp('+55 (44) 91234-5678');

$notification = new Notification('http://notification-api.example.com');

$notification->notify($message);
