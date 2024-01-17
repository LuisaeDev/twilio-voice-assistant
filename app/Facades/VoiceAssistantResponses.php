<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class VoiceAssistantResponses extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return VoiceAssistantResponses
     */
    protected static function getFacadeAccessor() {
        return \App\Contracts\VoiceAssistantResponses::class;
    }
}
