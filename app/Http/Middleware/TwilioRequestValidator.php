<?php

namespace App\Http\Middleware;

use App\Facades\TwilioClient;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Security\RequestValidator;

class TwilioRequestValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If this is a test environment, skip the validation
        if (env('APP_ENV') === 'local') {
            return $next($request);
        }

        // Get the Twilio auth token
        $authToken = TwilioClient::getAuthToken();

        // Create a Twilio Request Validator
        $validator = new RequestValidator($authToken);

        // Validate the incoming request
        $isValid = $validator->validate(
            $request->header('X-Twilio-Signature', ''),
            $request->fullUrl(),
            $request->toArray()
        );

        // If the request is not valid, reject it
        if (!$isValid) {
            return response('Twilio request validation failed', 403);
        }

        return $next($request);
    }
}
