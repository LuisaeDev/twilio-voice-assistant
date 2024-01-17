<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class VoiceAssistantHandlers extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return VoiceAssistantHandlers
     */
    protected static function getFacadeAccessor() {
        return \App\Contracts\VoiceAssistantHandlers::class;
    }
}
