<?php

namespace App\Services;

use App\Facades\TwilioClient;
use Twilio\TwiML\VoiceResponse;

class VoiceAssistantResponses implements \App\Contracts\VoiceAssistantResponses
{

    /**
     * Handle the incoming call
     *
     * @return VoiceResponse
     */
    public function incomingCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Gather user input to decide the action
        $response
            ->gather(['numDigits' => 1, 'action' => route('start-user-input')])
            ->say(__('voice_assistant.welcome'));

        return $response;
    }

    /**
     * Handle the start user input
     *
     * @return VoiceResponse
     */
    public function noAvailableAgent(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();
        $response->say(__('voice_assistant.no_available_agent'));
        $response->hangup();

        return $response;
    }

    /**
     * Forward the call to the agent's number
     *
     * @param string $agentPhoneNumber
     * @return VoiceResponse
     */
    public function forwardCallToAgent(string $agentPhoneNumber): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();
        
        // Say a connecting call message to the user and dial the agent
        $response->say(__('voice_assistant.forward_call_to_agent'));
        $response->dial($agentPhoneNumber, [
            'action' => route('agent-call'),
            'callerId' => TwilioClient::getPhoneNumber(),
        ]);

        return $response;
    }

    /**
     * Record a voice message
     *
     * @return VoiceResponse
     */
    public function recordVoiceMessage(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Record the message
        $response->say(__('voice_assistant.record_voice_message'));
        $response->record([
            'action' => route('record-voice-message'),
            'maxLength' => 20,
        ]);

        return $response;
    }

    /**
     * Record voice message, error
     *
     * @return VoiceResponse
     */
    public function recordVoiceMessageError(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user and hangup
        $response->say(__('voice_assistant.record_voice_message_error'));
        $response->hangup();

        return $response;
    }

    /**
     * Exit the incoming call.
     *
     * @return VoiceResponse
     */
    public function exitIncomingCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user and hangup
        $response->say(__('voice_assistant.exit_incoming_call'));
        $response->hangup();

        return $response;
    }

    /**
     * Wrong Start-Input-Answer response.
     *
     * @return VoiceResponse
     */
    public function wrongStartInputAnswer(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message and gather user input again
        $response
            ->gather(['numDigits' => 1, 'action' => route('start-user-input')])
            ->say(__('voice_assistant.wrong_start_input_answer'));

        return $response;
    }

    /**
     * Thanks for leaving message response.
     *
     * @return VoiceResponse
     */
    public function thanksForLeavingMessage(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user
        $response->say(__('voice_assistant.record_voice_message_thanks'));
        $response->hangup();

        return $response;
    }

    /**
     * Agent complete call response.
     *
     * @return VoiceResponse
     */
    public function agentCompleteCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user and hangup
        $response->say(__('voice_assistant.agent_complete_call'));
        $response->hangup();

        return $response;
    }

    /**
     * Agent no answer call response.
     *
     * @return VoiceResponse
     */
    public function agentNoAnswerCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user
        $response->say(__('voice_assistant.agent_no_answer_call'));
        $response->hangup();

        return $response;
    }

    /**
     * Agent busy call response.
     *
     * @return VoiceResponse
     */
    public function agentBusyCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();

        // Say a message to the user
        $response->say(__('voice_assistant.agent_busy_call'));
        $response->hangup();

        return $response;
    }

    /**
     * Agent failed call response.
     *
     * @return VoiceResponse
     */
    public function agentFailedCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();
        $response->say(__('voice_assistant.agent_failed_call'));
        $response->hangup();

        return $response;
    }
    
    /**
     * Agent fallback call response.
     *
     * @return VoiceResponse
     */
    public function agentFallbackCall(): VoiceResponse
    {
        // Initialize the TwiML response
        $response = new VoiceResponse();
        $response->say(__('voice_assistant.agent_fallback_call'));
        $response->hangup();

        return $response;
    }
}
