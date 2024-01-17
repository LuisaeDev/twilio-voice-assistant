<?php

namespace App\Contracts;

interface TwilioClient
{
    public function getClientInstance(): \Twilio\Rest\Client;
    public function getSid(): string;
    public function getAuthToken(): string;
    public function getPhoneNumber(): string;
    public function sendSMS(string $to, string $message): void;
}
