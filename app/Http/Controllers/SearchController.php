<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type', 'text');
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $latitude = $request->input('lat');
        $longitude = $request->input('lng');
        $radius = $request->input('radius', 10); // 10km default

        $products = Product::query()
            ->with(['shop', 'category'])
            ->where('is_active', true);

        // Text search
        if ($query && $type === 'text') {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'ILIKE', "%{$query}%")
                  ->orWhere('description', 'ILIKE', "%{$query}%")
                  ->orWhereHas('shop', function ($shopQuery) use ($query) {
                      $shopQuery->where('name', 'ILIKE', "%{$query}%");
                  })
                  ->orWhereHas('category', function ($catQuery) use ($query) {
                      $catQuery->where('name', 'ILIKE', "%{$query}%");
                  });
            });
        }

        // Category filter
        if ($category) {
            $products->where('category_id', $category);
        }

        // Price filters
        if ($minPrice) {
            $products->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $products->where('price', '<=', $maxPrice);
        }

        // Geolocation filter
        if ($latitude && $longitude) {
            $products->whereHas('shop', function ($shopQuery) use ($latitude, $longitude, $radius) {
                // Simple distance calculation (works for small areas)
                // For PostGIS, we'd use ST_Distance
                $shopQuery->whereRaw(
                    "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) <= ?",
                    [$latitude, $longitude, $latitude, $radius]
                );
            });
        }

        $products = $products->paginate(20);

        return view('search', [
            'products' => $products,
            'query' => $query,
            'type' => $type,
            'categories' => Category::whereNull('parent_id')->get(),
        ]);
    }

    public function api(Request $request)
    {
        $query = $request->input('q');
        $latitude = $request->input('lat');
        $longitude = $request->input('lng');
        $radius = $request->input('radius', 10);

        $products = Product::query()
            ->with(['shop', 'category', 'images'])
            ->where('is_active', true);

        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'ILIKE', "%{$query}%")
                  ->orWhere('description', 'ILIKE', "%{$query}%");
            });
        }

        if ($latitude && $longitude) {
            $products->whereHas('shop', function ($shopQuery) use ($latitude, $longitude, $radius) {
                $shopQuery->whereRaw(
                    "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) <= ?",
                    [$latitude, $longitude, $latitude, $radius]
                );
            });
        }

        $products = $products->limit(20)->get();

        return response()->json([
            'success' => true,
            'data' => $products,
            'count' => $products->count(),
        ]);
    }
}
