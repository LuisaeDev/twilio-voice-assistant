<?php

namespace App\Contracts;

use App\Models\Agent;

interface AgentsManager
{
    public function getAvailableAgent(): Agent|null;
    public function getSoonAvailableAgent(): Agent;
    public function markAgentAsAvailable(Agent $agent): void;
    public function markAgentAsUnavailable(Agent $agent): void;

}
