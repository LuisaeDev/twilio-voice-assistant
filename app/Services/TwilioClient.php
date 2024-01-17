<?php

namespace App\Services;

class TwilioClient implements \App\Contracts\TwilioClient
{
    
    /**
     * Get the Twilio client instance
     *
     * @return \Twilio\Rest\Client
     */
    public function getClientInstance(): \Twilio\Rest\Client
    {
        return new \Twilio\Rest\Client(
            $this->getSid(),
            $this->getAuthToken()
        );
    }

    /**
     * Get the Twilio SID
     *
     * @return string
     */
    public function getSid(): string
    {
        return config('twilio.sid');
    }

    /**
     * Get the Twilio auth token
     *
     * @return string
     */
    public function getAuthToken(): string
    {
        return config('twilio.auth_token');
    }

    /**
     * Get the Twilio phone number
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return config('twilio.phone_number');
    }

    /**
     * Send an SMS message
     *
     * @param string $to
     * @param string $message
     * @return void
     */
    public function sendSMS(string $to, string $message): void
    {
        $this->getClientInstance()->messages->create(
            $to,
            [
                'from' => $this->getPhoneNumber(),
                'body' => $message
            ]
        );
    }   
}
