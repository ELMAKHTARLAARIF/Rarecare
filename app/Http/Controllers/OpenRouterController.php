<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenRouterController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message', 'Hello');

        try {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type' => 'application/json',
                'HTTP-Referer' => env('APP_URL'),
                'X-OpenRouter-Title' => env('APP_NAME'),
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'openai/gpt-5.2',
                'max_tokens' => 512,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ]
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'reply' => 'API Error: ' . $response->body()
                ], 500);
            }

            $data = $response->json();

            $reply = $data['choices'][0]['message']['content'] ?? 'No response from AI';

            return response()->json([
                'reply' => $reply
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'reply' => 'Server Error: ' . $e->getMessage()
            ], 500);

        }
    }
}
