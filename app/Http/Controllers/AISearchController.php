<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\AISearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AISearchController extends Controller
{
    protected $aiService;

    public function __construct(AISearchService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Show AI search page
     */
    public function index()
    {
        $categories = Category::all();
        return view('search.ai-search', compact('categories'));
    }

    /**
     * Handle AI image search
     */
    public function searchByImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        try {
            // Store uploaded image temporarily
            $image = $request->file('image');
            $path = $image->store('temp', 'public');
            $fullPath = storage_path('app/public/' . $path);

            // Analyze image with AI
            $aiResult = $this->aiService->searchByImage($fullPath);

            // Clean up temporary file
            Storage::disk('public')->delete($path);

            if (!$aiResult['success']) {
                return response()->json([
                    'success' => false,
                    'error' => $aiResult['error'] ?? 'AI analysis failed'
                ], 500);
            }

            // Search products based on AI analysis
            $products = $this->searchProducts(
                $aiResult['keywords'] ?? [],
                $aiResult['category'] ?? '',
                $aiResult['product_name'] ?? ''
            );

            return response()->json([
                'success' => true,
                'ai_analysis' => [
                    'product_name' => $aiResult['product_name'] ?? '',
                    'category' => $aiResult['category'] ?? '',
                    'keywords' => $aiResult['keywords'] ?? [],
                    'color' => $aiResult['color'] ?? '',
                    'brand' => $aiResult['brand'] ?? '',
                    'description' => $aiResult['description'] ?? '',
                ],
                'products' => $products,
                'total_results' => $products->count(),
            ]);

        } catch (\Exception $e) {
            Log::error('Image Search Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to process image search. Please try again.'
            ], 500);
        }
    }

    /**
     * Handle AI text search
     */
    public function searchByText(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:200',
        ]);

        try {
            $query = $request->input('query');

            // Analyze query with AI
            $aiResult = $this->aiService->searchByText($query);

            if (!$aiResult['success']) {
                // Fallback to basic search if AI fails
                $products = Product::where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->with(['shop', 'category'])
                    ->paginate(20);

                return response()->json([
                    'success' => true,
                    'fallback' => true,
                    'products' => $products,
                    'total_results' => $products->total(),
                ]);
            }

            // Search products based on AI analysis
            $products = $this->searchProducts(
                $aiResult['keywords'] ?? [],
                $aiResult['category'] ?? '',
                $aiResult['refined_query'] ?? $query
            );

            return response()->json([
                'success' => true,
                'ai_analysis' => [
                    'category' => $aiResult['category'] ?? '',
                    'keywords' => $aiResult['keywords'] ?? [],
                    'refined_query' => $aiResult['refined_query'] ?? $query,
                    'filters' => $aiResult['filters'] ?? [],
                ],
                'products' => $products,
                'total_results' => $products->count(),
            ]);

        } catch (\Exception $e) {
            Log::error('Text Search Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to process text search. Please try again.'
            ], 500);
        }
    }

    /**
     * Search products based on AI extracted data
     */
    protected function searchProducts(array $keywords, string $category, string $productName)
    {
        $query = Product::with(['shop', 'category']);

        // Search by product name
        if (!empty($productName)) {
            $query->where(function ($q) use ($productName) {
                $q->where('name', 'like', "%{$productName}%")
                  ->orWhere('description', 'like', "%{$productName}%");
            });
        }

        // Search by category
        if (!empty($category)) {
            $categoryModel = Category::where('name', 'like', "%{$category}%")->first();
            if ($categoryModel) {
                $query->where('category_id', $categoryModel->id);
            }
        }

        // Search by keywords
        if (!empty($keywords)) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                }
            });
        }

        // Only active products
        $query->where('is_active', true);

        return $query->paginate(20);
    }

    /**
     * Show search results page
     */
    public function results(Request $request)
    {
        $query = $request->input('q', '');
        $category = $request->input('category', '');

        $categories = Category::all();

        return view('search.results', compact('query', 'category', 'categories'));
    }
}
