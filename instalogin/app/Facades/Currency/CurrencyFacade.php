<?php

namespace App\Facades\Currency;

use Illuminate\Support\Facades\Facade;

class RateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'currency_rate';
    }
}
