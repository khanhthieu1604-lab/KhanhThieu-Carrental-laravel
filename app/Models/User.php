<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Shared User model for Thiuu Ecosystem SSO
 * 
 * Uses shared_auth database connection for unified authentication
 * across Thiuu CarRental and KThiuu Hotel.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Use shared auth database for SSO
     * Falls back to default connection if shared_auth is not available
     */
    protected $connection = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Use shared_auth for Docker/production, default for local SQLite
        if (
            config('database.connections.shared_auth.host') &&
            env('USE_SHARED_AUTH', false)
        ) {
            $this->connection = 'shared_auth';
        }
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'avatar',
        'app_permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'app_permissions' => 'array',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return in_array($this->role, ['customer', 'user', null]);
    }

    /**
     * Check if user has access to specific app
     */
    public function hasAppAccess(string $app): bool
    {
        if ($this->isAdmin()) return true;

        $permissions = $this->app_permissions ?? ['car_rental' => true, 'hotel' => true];
        return $permissions[$app] ?? true;
    }

    /**
     * Car rental bookings (from Thiuu CarRental app)
     */
    public function carBookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    /**
     * Alias for backward compatibility
     */
    public function bookings()
    {
        return $this->carBookings();
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    /**
     * SSO tokens for cross-app authentication
     */
    public function ssoTokens()
    {
        return $this->hasMany(\App\Models\SsoToken::class);
    }
}
