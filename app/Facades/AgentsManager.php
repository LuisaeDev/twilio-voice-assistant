<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AgentsManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return Agents
     */
    protected static function getFacadeAccessor() {
        return \App\Contracts\AgentsManager::class;
    }
}
