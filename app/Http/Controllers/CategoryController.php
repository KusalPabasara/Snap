<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->withCount('products')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->with(['shop', 'category'])
            ->where('is_active', true)
            ->paginate(20);

        $childCategories = Category::where('parent_id', $category->id)->get();

        return view('categories.show', compact('category', 'products', 'childCategories'));
    }
}
