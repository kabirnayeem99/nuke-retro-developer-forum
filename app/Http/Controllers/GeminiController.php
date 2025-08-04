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
                            'text' => 'Generate a very weird, science fiction type forum thread about ' . $categoryName . '. Include a title and a body for the post. Keep the tone reddit like, with a Indian vibe, no blasphemy.'
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

            $this->generateRepliesForThread($thread);

            return redirect()->route('threads.show', compact('thread'))->with('success', 'Thread created successfully.');
        } catch (\Exception $e) {
            Log::error('An exception occurred during Gemini API call.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('threads.show', compact('thread'))->with('Failure', 'Thread creation failed.');
        }
    }

    private function generateRepliesForThread(Thread $thread)
    {
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";
        $apiKey = config('services.gemini.api_key');

        if (!$apiKey) {
            return;
        }

        $faker = \Faker\Factory::create();
        $randomCount = rand(2, 5); // Number of replies

        try {
            foreach (range(1, $randomCount) as $_) {
                $payload = [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "Write a weird, sarcastic or surreal reply comment to a forum thread titled: '{$thread->title}'. Keep a reddit-like tone, with a Indian vibe. The reply should have a Indian vibe and arabic lone words and slurs, no blasphemy."
                                ]
                            ]
                        ]
                    ],
                    'generation_config' => [
                        'response_mime_type' => 'application/json',
                        'response_schema' => [
                            'type' => 'object',
                            'properties' => [
                                'body' => [
                                    'type' => 'string'
                                ]
                            ],
                            'required' => ['body']
                        ]
                    ]
                ];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'X-goog-api-key' => $apiKey,
                ])->post($apiUrl, $payload);

                if ($response->failed()) {
                    Log::warning("Failed to get reply from Gemini for thread: {$thread->id}");
                    continue;
                }

                // The model's response is nested; extract the JSON string
                $responseContent = $response->json();
                $generatedText = $responseContent['candidates'][0]['content']['parts'][0]['text'];

                // Since we specified JSON output with a schema, we can decode it directly
                $postData = json_decode($generatedText, true);
                $responseContent = $response->json();

                $thread->posts()->create([
                    'body' => $postData['body'] ?? fake()->sentence(10),
                    'user_id' => User::inRandomOrder()->first()->id,
                    'thread_id' => $thread->id,
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error generating replies', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}