<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Str;

class GeminiController extends Controller
{

    public function generateSciFiThread()
    {
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";
        $apiKey = config('services.gemini.api_key');

        if (!$apiKey) {
            return response()->json(['error' => 'Gemini API key is not configured.'], 500);
        }

        $randomCategory = Category::inRandomOrder()->first();

        $categoryName = $randomCategory->name ?? 'Sci-Fi';

        // The exact payload from your curl command, as a PHP array
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'Generate a very weird, science fiction type forum thread about ' . $categoryName . '. Include a title and a body for the post.'
                        ]
                    ]
                ]
            ],
            'generation_config' => [
                'response_mime_type' => 'application/json',
                'response_schema' => [
                    'type' => 'object',
                    'properties' => [
                        'title' => [
                            'type' => 'string'
                        ],
                        'body' => [
                            'type' => 'string'
                        ]
                    ],
                    'required' => ['title', 'body']
                ]
            ]
        ];

        try {
            // Use Laravel's Http facade to make the POST request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $apiKey, // Directly set the API key in the header
            ])->post($apiUrl, $payload);

            // Handle potential API errors
            if ($response->failed()) {
                Log::error('Gemini API request failed.', [
                    'status' => $response->status(),
                    'response' => $response->json(),
                ]);
                return response()->json([
                    'error' => 'API request failed',
                    'details' => $response->json(),
                ], $response->status());
            }

            // The model's response is nested; extract the JSON string
            $responseContent = $response->json();
            $generatedText = $responseContent['candidates'][0]['content']['parts'][0]['text'];

            // Since we specified JSON output with a schema, we can decode it directly
            $threadData = json_decode($generatedText, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                // Log a warning if the JSON is malformed
                Log::warning('Gemini returned malformed JSON.', ['response' => $generatedText]);
                return response()->json([
                    'error' => 'Failed to parse JSON response from Gemini.',
                    'raw_response' => $generatedText
                ], 500);
            }

            // Return the parsed data


            $thread = Thread::create([
                'title' => $threadData['title'],
                'body' => $threadData['body'],
                'user_id' => User::inRandomOrder()->first()->id,
                'slug' => Str::slug($threadData['title']),
                'category_id' => $randomCategory->id,
            ]);


            return redirect()->route('threads.show', compact('thread'))->with('success', 'Thread created successfully.');
        } catch (\Exception $e) {
            Log::error('An exception occurred during Gemini API call.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'error' => 'An internal server error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}