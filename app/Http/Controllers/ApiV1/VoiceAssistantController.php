<?php

namespace App\Http\Controllers\ApiV1;

use App\Facades\VoiceAssistantHandlers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class VoiceAssistantController extends Controller
{

    /**
     * Handle the incoming call
     *
     * @return Response
     */
    public function incomingCall(): Response
    {
        // Handle the incoming call
        $response = VoiceAssistantHandlers::incomingCall();

        // Emit the TwiML response
        return response($response)->header('Content-Type', 'text/xml');
    }

    /**
     * Handle the first menu user input
     *
     * @return Response
     */
    public function startUserInput(): Response
    {
        // Get the data from the request
        $data = request()->all();

        // Handle the first menu user input
        $response = VoiceAssistantHandlers::startUserInput($data);

        // Emit the TwiML response
        return response($response)->header('Content-Type', 'text/xml');
    }

    /**
     * Handle the recorded voice message
     *
     * @return Response
     */
    public function recordVoiceMessage(): Response
    {
        // Get the data from the request
        $data = request()->all();

        // Handle the recorded voice message
        $response = VoiceAssistantHandlers::recordVoiceMessage($data);
        
        // Emit the TwiML response
        return response($response)->header('Content-Type', 'text/xml');        
    }

    /**
     * Handle the agent answered call
     *
     * @return Response
     */
    public function agentCall(): Response
    {
        // Get the data from the request
        $data = request()->all();

        // Handle the agent answered call
        $response = VoiceAssistantHandlers::agentCall($data);
        
        // Emit the TwiML response
        return response($response)->header('Content-Type', 'text/xml');        
    }
}
