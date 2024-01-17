<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TwilioClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return TwilioClient
     */
    protected static function getFacadeAccessor() {
        return \App\Contracts\TwilioClient::class;
    }
}
