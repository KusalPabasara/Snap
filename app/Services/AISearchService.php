<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AISearchService
{
    protected $provider;
    protected $openaiKey;
    protected $geminiKey;

    public function __construct()
    {
        $this->provider = config('services.ai_provider', 'openai');
        $this->openaiKey = config('services.openai.api_key');
        $this->geminiKey = config('services.gemini.api_key');
    }

    /**
     * Search products using AI image recognition
     */
    public function searchByImage(string $imagePath): array
    {
        try {
            // Read and encode image
            $imageData = base64_encode(file_get_contents($imagePath));
            $mimeType = mime_content_type($imagePath);

            if ($this->provider === 'openai') {
                return $this->searchWithOpenAIVision($imageData, $mimeType);
            } else {
                return $this->searchWithGeminiVision($imageData, $mimeType);
            }
        } catch (\Exception $e) {
            Log::error('AI Image Search Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Failed to process image search',
                'keywords' => [],
                'categories' => [],
                'description' => ''
            ];
        }
    }

    /**
     * Search products using AI text understanding
     */
    public function searchByText(string $query): array
    {
        try {
            if ($this->provider === 'openai') {
                return $this->searchWithOpenAI($query);
            } else {
                return $this->searchWithGemini($query);
            }
        } catch (\Exception $e) {
            Log::error('AI Text Search Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Failed to process text search',
                'keywords' => [],
                'categories' => [],
                'refined_query' => $query
            ];
        }
    }

    /**
     * OpenAI Vision API for image analysis
     */
    protected function searchWithOpenAIVision(string $imageData, string $mimeType): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->openaiKey,
            'Content-Type' => 'application/json',
        ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
            'model' => config('services.openai.vision_model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a product recognition expert. Analyze images and extract: product name, category, keywords, color, brand, and detailed description. Return JSON format.'
                ],
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Analyze this product image and provide: 1) Product name/type, 2) Category (electronics, fashion, home, sports, food, beauty, books, toys), 3) Keywords (comma-separated), 4) Color, 5) Brand if visible, 6) Detailed description. Format as JSON: {"product_name": "", "category": "", "keywords": [], "color": "", "brand": "", "description": ""}'
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => "data:{$mimeType};base64,{$imageData}"
                            ]
                        ]
                    ]
                ]
            ],
            'max_tokens' => 500
        ]);

        if ($response->successful()) {
            $result = $response->json();
            $content = $result['choices'][0]['message']['content'] ?? '';

            // Parse JSON from response
            $parsed = $this->parseAIResponse($content);

            return [
                'success' => true,
                'product_name' => $parsed['product_name'] ?? '',
                'category' => $parsed['category'] ?? '',
                'keywords' => $parsed['keywords'] ?? [],
                'color' => $parsed['color'] ?? '',
                'brand' => $parsed['brand'] ?? '',
                'description' => $parsed['description'] ?? '',
                'raw_response' => $content
            ];
        }

        return ['success' => false, 'error' => 'OpenAI API request failed'];
    }

    /**
     * OpenAI GPT for text search
     */
    protected function searchWithOpenAI(string $query): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->openaiKey,
            'Content-Type' => 'application/json',
        ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
            'model' => config('services.openai.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a product search assistant. Extract product details from user queries and suggest relevant categories and keywords for shopping.'
                ],
                [
                    'role' => 'user',
                    'content' => "User is searching for: \"{$query}\". Extract: 1) Product category (electronics, fashion, home, sports, food, beauty, books, toys), 2) Keywords for search, 3) Refined search query, 4) Suggested filters (price range, brand, color). Format as JSON: {\"category\": \"\", \"keywords\": [], \"refined_query\": \"\", \"filters\": {}}"
                ]
            ],
            'max_tokens' => 300
        ]);

        if ($response->successful()) {
            $result = $response->json();
            $content = $result['choices'][0]['message']['content'] ?? '';

            $parsed = $this->parseAIResponse($content);

            return [
                'success' => true,
                'category' => $parsed['category'] ?? '',
                'keywords' => $parsed['keywords'] ?? [],
                'refined_query' => $parsed['refined_query'] ?? $query,
                'filters' => $parsed['filters'] ?? [],
                'raw_response' => $content
            ];
        }

        return ['success' => false, 'error' => 'OpenAI API request failed'];
    }

    /**
     * Google Gemini Vision API for image analysis
     */
    protected function searchWithGeminiVision(string $imageData, string $mimeType): array
    {
        $response = Http::timeout(30)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$this->geminiKey}",
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => 'Analyze this product image and provide: 1) Product name/type, 2) Category (electronics, fashion, home, sports, food, beauty, books, toys), 3) Keywords (comma-separated), 4) Color, 5) Brand if visible, 6) Detailed description. Format as JSON: {"product_name": "", "category": "", "keywords": [], "color": "", "brand": "", "description": ""}'
                            ],
                            [
                                'inline_data' => [
                                    'mime_type' => $mimeType,
                                    'data' => $imageData
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        if ($response->successful()) {
            $result = $response->json();
            $content = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

            $parsed = $this->parseAIResponse($content);

            return [
                'success' => true,
                'product_name' => $parsed['product_name'] ?? '',
                'category' => $parsed['category'] ?? '',
                'keywords' => $parsed['keywords'] ?? [],
                'color' => $parsed['color'] ?? '',
                'brand' => $parsed['brand'] ?? '',
                'description' => $parsed['description'] ?? '',
                'raw_response' => $content
            ];
        }

        return ['success' => false, 'error' => 'Gemini API request failed'];
    }

    /**
     * Google Gemini for text search
     */
    protected function searchWithGemini(string $query): array
    {
        $response = Http::timeout(30)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$this->geminiKey}",
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "User is searching for: \"{$query}\". Extract: 1) Product category (electronics, fashion, home, sports, food, beauty, books, toys), 2) Keywords for search, 3) Refined search query, 4) Suggested filters (price range, brand, color). Format as JSON: {\"category\": \"\", \"keywords\": [], \"refined_query\": \"\", \"filters\": {}}"
                            ]
                        ]
                    ]
                ]
            ]
        );

        if ($response->successful()) {
            $result = $response->json();
            $content = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

            $parsed = $this->parseAIResponse($content);

            return [
                'success' => true,
                'category' => $parsed['category'] ?? '',
                'keywords' => $parsed['keywords'] ?? [],
                'refined_query' => $parsed['refined_query'] ?? $query,
                'filters' => $parsed['filters'] ?? [],
                'raw_response' => $content
            ];
        }

        return ['success' => false, 'error' => 'Gemini API request failed'];
    }

    /**
     * Parse AI response (handles both JSON and text responses)
     */
    protected function parseAIResponse(string $content): array
    {
        // Try to extract JSON from markdown code blocks
        if (preg_match('/```json\s*(\{.*?\})\s*```/s', $content, $matches)) {
            $content = $matches[1];
        } elseif (preg_match('/```\s*(\{.*?\})\s*```/s', $content, $matches)) {
            $content = $matches[1];
        }

        // Try to decode JSON
        $decoded = json_decode($content, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // If JSON parsing fails, return empty array
        return [];
    }
}
