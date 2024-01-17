<?php

namespace App\Services;

use App\Facades\AgentsManager;
use App\Facades\TwilioClient;
use App\Facades\VoiceAssistantResponses;
use App\Models\CallTrack;
use Twilio\TwiML\VoiceResponse;

class VoiceAssistantHandlers implements \App\Contracts\VoiceAssistantHandlers
{
    
    /**
     * Handle the incoming call
     *
     * @return VoiceResponse
     */
    public function incomingCall(): VoiceResponse
    {
        return VoiceAssistantResponses::incomingCall();
    }

    /**
     * Handle the start user input
     *
     * @param array $data
     * @return VoiceResponse
     */
    public function startUserInput(array $data): VoiceResponse
    {
        // Handle the input given by the user
        switch ($data['Digits']) {
            
            // Forward the call to an agent
            case '1':
                
                // Get an available agent
                $agent = AgentsManager::getAvailableAgent();

                // If there are no agents available
                if (is_null($agent)) {
                    return VoiceAssistantResponses::noAvailableAgent();
                }

                // Create a new call track
                CallTrack::create([
                    'sid' => $data['CallSid'],
                    'from' => $data['From'],
                    'status' => $data['CallStatus'],
                    'agent_id' => $agent->id
                ]);

                // Mark the agent as unavailable
                AgentsManager::markAgentAsUnavailable($agent);

                // Forward the call to the agent
                return VoiceAssistantResponses::forwardCallToAgent($agent->phone_number);

            // Record a voice message
            case '2':

                // Get a soon available agent
                $agent = AgentsManager::getSoonAvailableAgent();

                // Create a new call track
                CallTrack::create([
                    'sid' => $data['CallSid'],
                    'from' => $data['From'],
                    'status' => $data['CallStatus'],
                    'agent_id' => $agent->id
                ]);

                return VoiceAssistantResponses::recordVoiceMessage();

            // End the call
            case '9':
                return VoiceAssistantResponses::exitIncomingCall();

            default:
                return VoiceAssistantResponses::wrongStartInputAnswer();
        }
    }

    /**
     * Handle the record voice message
     *
     * @param array $data
     * @return VoiceResponse
     */
    public function recordVoiceMessage(array $data): VoiceResponse
    {
        // Get the corresponding call track
        $callTrack = CallTrack::where('sid', $data['CallSid'])->first();

        // If there is no call track
        if (is_null($callTrack)) {
            return VoiceAssistantResponses::recordVoiceMessageError();

            // Delete the recording
            TwilioClient::getClientInstance()->recordings($data['RecordingSid'])->delete();
        }
        
        // Update the call track
        $callTrack->update([
            'status' => 'completed',
            'recording_sid' => $data['RecordingSid'],
            'recording_url' => $data['RecordingUrl'],
        ]);

        // Send an SMS to the agent with the recording URL
        TwilioClient::sendSMS(
            $callTrack->agent->phone_number,
            'You have a new voice message. Listen to it here: ' . $callTrack->recording_url
        );

        return VoiceAssistantResponses::thanksForLeavingMessage();
    }

    /**
     * Handle the agent call
     *
     * @return VoiceResponse
     */
    public function agentCall(array $data): VoiceResponse
    {
        // Get the corresponding call track and update its status
        CallTrack::query()
            ->where('sid', $data['CallSid'])
            ->update([
                'status' => $data['CallStatus']
            ]);
        
        switch ($data['DialCallStatus']) {
            case 'completed':

                // Get the corresponding call track
                $callTrack = CallTrack::where('sid', $data['CallSid'])->first();
                if (!is_null($callTrack)) {

                    // Mark the agent as available
                    AgentsManager::markAgentAsAvailable($callTrack->agent);
                }

                return VoiceAssistantResponses::agentCompleteCall();
                
            case 'no-answer':
                return VoiceAssistantResponses::agentNoAnswerCall();

            case 'busy':
                return VoiceAssistantResponses::agentBusyCall();

            case 'failed':
                return VoiceAssistantResponses::agentFailedCall();

            default:
                return VoiceAssistantResponses::agentFallbackCall();
        }
    }
}
