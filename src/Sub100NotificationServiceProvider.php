<?php

namespace sub100\Notifications;

use Illuminate\Support\ServiceProvider;

class Sub100NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sub100.php' => config_path('sub100.php'),
        ], 'sub100-config');

        $this->app->singleton('Sub100Notification', function ($app) {
            return new Notification(config('sub100.notification_url'));
        });
    }

    public function register()
    {
        //
    }
}
