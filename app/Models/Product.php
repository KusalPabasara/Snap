<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'sku',
        'image_url',
        'metadata',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }

    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for in-stock products
    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }
}
