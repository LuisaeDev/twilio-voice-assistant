<?php

namespace App\Contracts;

use Twilio\TwiML\VoiceResponse;

interface VoiceAssistantHandlers
{
    public function incomingCall(): VoiceResponse;
    public function startUserInput(array $data): VoiceResponse;
    public function recordVoiceMessage(array $data): VoiceResponse;
    public function agentCall(array $data): VoiceResponse;
}
