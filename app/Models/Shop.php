<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'subscription_tier',
        'verified_at',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        // Update location geography column when latitude/longitude changes
        static::saving(function ($shop) {
            if ($shop->isDirty(['latitude', 'longitude']) && $shop->latitude && $shop->longitude) {
                DB::statement("
                    UPDATE shops
                    SET location = ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography
                    WHERE id = ?
                ", [$shop->longitude, $shop->latitude, $shop->id]);
            }
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    // Scope for active shops
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for verified shops
    public function scopeVerified($query)
    {
        return $query->whereNotNull('verified_at');
    }

    /**
     * Scope to find shops within a certain distance from a point
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $latitude
     * @param float $longitude
     * @param float $distanceInMeters Distance in meters (default: 5000m = 5km)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNearby($query, $latitude, $longitude, $distanceInMeters = 5000)
    {
        return $query->whereRaw("
            ST_DWithin(
                location,
                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography,
                ?
            )
        ", [$longitude, $latitude, $distanceInMeters])
        ->selectRaw("
            *,
            ST_Distance(
                location,
                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography
            ) as distance_meters
        ", [$longitude, $latitude])
        ->orderBy('distance_meters');
    }

    /**
     * Scope to order shops by distance from a point
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $latitude
     * @param float $longitude
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByDistance($query, $latitude, $longitude)
    {
        return $query->selectRaw("
            *,
            ST_Distance(
                location,
                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography
            ) as distance_meters
        ", [$longitude, $latitude])
        ->orderBy('distance_meters');
    }

    /**
     * Get distance to a specific point in meters
     *
     * @param float $latitude
     * @param float $longitude
     * @return float|null Distance in meters
     */
    public function distanceTo($latitude, $longitude)
    {
        $result = DB::selectOne("
            SELECT ST_Distance(
                location,
                ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography
            ) as distance
            FROM shops
            WHERE id = ?
        ", [$longitude, $latitude, $this->id]);

        return $result ? round($result->distance, 2) : null;
    }

    /**
     * Get formatted distance (e.g., "2.5 km" or "450 m")
     *
     * @param float $latitude
     * @param float $longitude
     * @return string
     */
    public function formattedDistanceTo($latitude, $longitude)
    {
        $distance = $this->distanceTo($latitude, $longitude);

        if ($distance === null) {
            return 'N/A';
        }

        if ($distance >= 1000) {
            return round($distance / 1000, 1) . ' km';
        }

        return round($distance) . ' m';
    }
}
