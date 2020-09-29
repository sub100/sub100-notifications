<?php

namespace sub100\Notifications\Facades;

use Illuminate\Support\Facades\Facade;

class Notification extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Sub100Notification';
    }
}
