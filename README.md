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
$message->subject('Subject');
$message->mailTemplate('notification.template.dir.filename');
$message->mailVariables(['name' => 'User']);
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

$authToken = '';

$message = new Message();
$message->message('Message text');
$message->addWhatsapp('+55 (44) 91234-5678');

$notification = new Notification('http://notification-api.example.com');

$notification->notify($message, $authToken);
```

___


### Other Examples

Send Twilio Whatsapp message
```php
<?php

$authToken = '';

$message = new Message();
$message->message('Message text');
$message->addWhatsapp('+55 (44) 91234-5678');
$message->senderServiceType('twilio');
$message->senderServiceCredentials([
    "twilio_auth_token"   => "8b74ff6655248c86fe0813e07d0f58a8",
    "twilio_account_sid"  => "AC16909ae3f38b03c7495d7dfbfd9dcbb4",
    "twilio_from"         => "whatsapp:+14155238886"
]);

$notification = new Notification('http://notification-api.example.com');

$notification->notify($message, $authToken);

```

Send Email with pre-defined mail body
```php
<?php

$authToken = '';

$message = new Message();
$message->mailBody('<p>Message text</p>');
$message->addEmail('test@example.com.br');

$notification = new Notification('http://notification-api.example.com');

$notification->notify($message, $authToken);
```

Get notifications history
```php

$authToken = '';

$originId = '';

$clientIds = ['',];

$notificationIds = ['',];

$notification = new Notification('http://notification-api.example.com');

$notification->historyByOrigin($originId, $authToken)

$notification->historyByClientAndOrigin($clientIds, $originId, $authToken);

$notification->historyByNotificationAndOrigin($notificationIds, $originId, $authToken)

```