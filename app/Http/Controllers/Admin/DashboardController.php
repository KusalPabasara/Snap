<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_shops' => Shop::count(),
            'active_shops' => Shop::where('status', 'active')->count(),
            'pending_shops' => Shop::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_categories' => Category::count(),
        ];

        $recentShops = Shop::latest()->take(10)->with('owner')->get();
        $recentUsers = User::latest()->take(10)->get();
        $recentProducts = Product::latest()->take(10)->with(['shop', 'category'])->get();

        // Shop status breakdown
        $shopsByStatus = Shop::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Products by category
        $productsByCategory = Product::select('category_id', DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->with('category:id,name')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category->name ?? 'Unknown',
                    'count' => $item->count
                ];
            });

        return view('admin.dashboard', compact(
            'stats',
            'recentShops',
            'recentUsers',
            'recentProducts',
            'shopsByStatus',
            'productsByCategory'
        ));
    }

    public function shops()
    {
        $shops = Shop::with('owner')->latest()->paginate(20);
        return view('admin.shops', compact('shops'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::with(['shop', 'category'])->latest()->paginate(20);
        return view('admin.products', compact('products'));
    }

    public function approveShop($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->update([
            'status' => 'active',
            'verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Shop approved successfully!');
    }

    public function rejectShop($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->update(['status' => 'inactive']);

        return redirect()->back()->with('success', 'Shop rejected successfully!');
    }
}
