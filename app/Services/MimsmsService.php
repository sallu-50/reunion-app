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

        try {
            $response = Http::timeout(10)
                ->retry(3, 200)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Accept' => 'application/json',
                ])
                ->post($baseUrl . '/api/v1/sms/send', [
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

            return true;

        } catch (\Throwable $e) {
            Log::error('MIMSMS exception', [
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }
}