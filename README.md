# Sub100 Notifications Laravel SDK

This package uses Sub100 notification api to send email and sms notifications.

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
