<?php

namespace App\Contracts;

use Twilio\TwiML\VoiceResponse;

interface VoiceAssistantResponses
{
    public function incomingCall(): VoiceResponse;
    public function noAvailableAgent(): VoiceResponse;
    public function forwardCallToAgent(string $agentPhoneNumber): VoiceResponse;
    public function recordVoiceMessage(): VoiceResponse;
    public function recordVoiceMessageError(): VoiceResponse;
    public function exitIncomingCall(): VoiceResponse;
    public function wrongStartInputAnswer(): VoiceResponse;
    public function thanksForLeavingMessage(): VoiceResponse;
    public function agentCompleteCall(): VoiceResponse;
    public function agentNoAnswerCall(): VoiceResponse;
    public function agentBusyCall(): VoiceResponse;
    public function agentFailedCall(): VoiceResponse;
    public function agentFallbackCall(): VoiceResponse;
}
