<?php

namespace sub100\Notifications\Facades;

use Illuminate\Support\Facades\Facade;
use sub100\Notifications\Message;

/**
 * @method bool notify(Message $message, string $token = '')
 */
class Notification extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Sub100Notification';
    }
}
