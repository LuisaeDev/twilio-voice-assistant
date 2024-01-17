<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiV1\VoiceAssistantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('twilio.request-validator')->prefix('v1/voice-assistant')->group(function() {
    Route::controller(VoiceAssistantController::class)->group(function () {

        Route::post('incoming-call', 'incomingCall')->name('incoming-call');
        Route::get('start-user-input', 'startUserInput')->name('start-user-input');
        Route::get('record-voice-message', 'recordVoiceMessage')->name('record-voice-message');
        Route::get('agent-call', 'agentCall')->name('agent-call');

    });
});
