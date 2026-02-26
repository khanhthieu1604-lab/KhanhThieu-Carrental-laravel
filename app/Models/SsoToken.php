<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * SSO Token for cross-app authentication
 * 
 * Used to securely transfer authentication between
 * Thiuu CarRental and KThiuu Hotel without re-login.
 */
class SsoToken extends Model
{
    protected $connection = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (
            config('database.connections.shared_auth.host') &&
            env('USE_SHARED_AUTH', false)
        ) {
            $this->connection = 'shared_auth';
        }
    }

    protected $fillable = [
        'user_id',
        'token',
        'source_app',
        'target_app',
        'expires_at',
        'used_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'used_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a new SSO token for cross-app redirect
     */
    public static function generateFor(User $user, string $sourceApp, string $targetApp): self
    {
        return static::create([
            'user_id' => $user->id,
            'token' => Str::random(64),
            'source_app' => $sourceApp,
            'target_app' => $targetApp,
            'expires_at' => now()->addMinutes(5), // Short-lived for security
        ]);
    }

    /**
     * Find and validate a token
     */
    public static function findValid(string $token, string $targetApp): ?self
    {
        return static::where('token', $token)
            ->where('target_app', $targetApp)
            ->where('expires_at', '>', now())
            ->whereNull('used_at')
            ->first();
    }

    /**
     * Mark token as used (one-time use)
     */
    public function markAsUsed(): void
    {
        $this->update(['used_at' => now()]);
    }

    /**
     * Check if token is valid
     */
    public function isValid(): bool
    {
        return $this->expires_at->isFuture() && is_null($this->used_at);
    }
}
