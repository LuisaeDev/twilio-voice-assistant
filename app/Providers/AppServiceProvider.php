<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the Twilio service
        $this->app->singleton(
            \App\Contracts\TwilioClient::class,
            \App\Services\TwilioClient::class
        );

        // Register the Voice-Assistant-Handlers service
        $this->app->bind(
            \App\Contracts\VoiceAssistantHandlers::class,
            \App\Services\VoiceAssistantHandlers::class
        );

        // Register the Voice-Assistant-Responses service
        $this->app->bind(
            \App\Contracts\VoiceAssistantResponses::class,
            \App\Services\VoiceAssistantResponses::class
        );

        // Register the Agents service
        $this->app->bind(
            \App\Contracts\AgentsManager::class,
            \App\Services\AgentsManager::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
