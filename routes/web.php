<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('home');
})->name('home');

// Issues & Roadmap
Route::get('/issues', function () {
    return view('issues');
})->name('issues');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/api/search', [SearchController::class, 'api'])->name('api.search');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Shops
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/nearby', [\App\Http\Controllers\NearbyShopsController::class, 'view'])->name('shops.nearby');
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');

// API - Nearby shops
Route::get('/api/shops/nearby', [\App\Http\Controllers\NearbyShopsController::class, 'index'])->name('api.shops.nearby');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/register-shop', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/register-shop', [ShopController::class, 'store'])->name('shops.store');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/shops', [\App\Http\Controllers\Admin\DashboardController::class, 'shops'])->name('shops');
    Route::get('/users', [\App\Http\Controllers\Admin\DashboardController::class, 'users'])->name('users');
    Route::get('/products', [\App\Http\Controllers\Admin\DashboardController::class, 'products'])->name('products');
    Route::post('/shops/{id}/approve', [\App\Http\Controllers\Admin\DashboardController::class, 'approveShop'])->name('shops.approve');
    Route::post('/shops/{id}/reject', [\App\Http\Controllers\Admin\DashboardController::class, 'rejectShop'])->name('shops.reject');
});

require __DIR__.'/auth.php';
