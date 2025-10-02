<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;

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
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');
Route::get('/register-shop', [ShopController::class, 'create'])->name('shops.create');
Route::post('/register-shop', [ShopController::class, 'store'])->name('shops.store');
