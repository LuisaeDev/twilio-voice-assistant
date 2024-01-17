<?php

namespace App\Services;

use App\Models\Agent;

class AgentsManager implements \App\Contracts\AgentsManager
{
    
    /**
     * Get an available agent.
     *
     * @return Agent|null
     */
    public function getAvailableAgent(): Agent|null
    {
        return Agent::query()
            ->with('user')
            ->where('available', true)
            ->first();
    }

    /**
     * Get an agent that will be available soon.
     *
     * @return Agent
     */
    public function getSoonAvailableAgent(): Agent
    {

        // Place some logic here to get an agent that will be available soon ...

        // Return (for now) an agent that will be available soon
        return Agent::query()
            ->with('user')
            ->inRandomOrder()
            ->first();
    }

    /**
     * Mark an agent as available.
     *
     * @param Agent $agent
     * @return void
     */
    public function markAgentAsAvailable(Agent $agent): void
    {
        $agent->update(['available' => true]);
    }

    /**
     * Mark an agent as unavailable.
     *
     * @param Agent $agent
     * @return void
     */
    public function markAgentAsUnavailable(Agent $agent): void
    {
        $agent->update(['available' => false]);
    }
}
