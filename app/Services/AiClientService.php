<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiClientService
{
    protected string $apiKey;

    protected string $model;

    protected string $endpoint;

    public function __construct()
    {
        $this->apiKey   = config('services.openai.key');
        $this->endpoint = config('services.openai.end_point');
        $this->model    = config('services.openai.model');
    }

    /**
     * Send a prompt to AI and return plain text recommendations.
     */
    public function getRecommendations(string $prompt): ?string
    {
        try {
            $response = Http::withToken($this->apiKey)->post($this->endpoint, [
                'model'    => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful e-commerce recommender assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens'  => 200,
                'temperature' => 0.2,
            ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            }
            Log::warning('AI API failed', [
                'prompt' => $prompt,
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('AI recommendation error: ' . $e->getMessage());
        }

        return null;
    }
}
