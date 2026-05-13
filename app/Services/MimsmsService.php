<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MimsmsService
{
    public function send(string $phone, string $message): bool
    {
        $baseUrl = config('services.mimsms.base_url');
        $apiKey = config('services.mimsms.key');
        $sender = config('services.mimsms.sender');

        if (! $baseUrl || ! $apiKey) {
            Log::error('MIMSMS misconfigured');
            return false;
        }

        $endpoint = config('services.mimsms.endpoint', '/api/v1/sms/send');

        try {
            $url = rtrim($baseUrl, '/') . '/' . ltrim($endpoint, '/');

            // Log request details for debugging (do not log API key)
            Log::info('MIMSMS request', [
                'url' => $url,
                'to' => $phone,
                'sender' => $sender,
            ]);

            $response = Http::timeout(10)
                ->retry(3, 200)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Accept' => 'application/json',
                ])
                ->post($url, [
                    'to' => $phone,
                    'message' => $message,
                    'sender' => $sender,
                ]);

            if (! $response->successful()) {
                Log::error('MIMSMS HTTP failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return false;
            }

            Log::info('MIMSMS sent successfully', ['to' => $phone]);
            return true;

        } catch (\Throwable $e) {
            // If the exception has a response (Guzzle), try to include it
            $body = null;
            if (method_exists($e, 'getResponse') && $e->getResponse()) {
                try {
                    $body = (string) $e->getResponse()->getBody();
                } catch (\Throwable $_) {
                    $body = null;
                }
            }

            Log::error('MIMSMS exception', [
                'error' => $e->getMessage(),
                'response_body' => $body,
            ]);

            return false;
        }
    }
}