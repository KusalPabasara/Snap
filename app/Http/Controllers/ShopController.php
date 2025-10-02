<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::where('status', 'active')
            ->with('owner')
            ->latest()
            ->paginate(20);

        return view('shops.index', compact('shops'));
    }

    public function show($id)
    {
        $shop = Shop::with(['products' => function ($query) {
            $query->where('is_active', true);
        }])->findOrFail($id);

        return view('shops.show', compact('shop'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('shops.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        // In production, you'd get owner_id from auth()
        $validated['owner_id'] = 1; // Placeholder
        $validated['status'] = 'pending';

        $shop = Shop::create($validated);

        return redirect()->route('shops.show', $shop)
            ->with('success', 'Shop registered successfully! Awaiting approval.');
    }
}
