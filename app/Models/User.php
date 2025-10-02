<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'location_lat',
        'location_lng',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'location_lat' => 'decimal:7',
            'location_lng' => 'decimal:7',
        ];
    }

    public function shops()
    {
        return $this->hasMany(Shop::class, 'owner_id');
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function isShopOwner(): bool
    {
        return $this->role === 'shop_owner';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
