<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

/**
 * Vehicle model - represents rental vehicles in the system
 * 
 * @property int $id
 * @property int $brand_id
 * @property string $name - Vehicle name/model
 * @property string $type - Vehicle category (Sedan, SUV, Coupe, etc.)
 * @property int $price - Daily rental price in VND
 * @property string $description - Vehicle description
 * @property string $status - available|rented|maintenance
 * @property string $image - Image URL or storage path
 * 
 * @property Brand $brand
 * @property Collection $reviews
 */
class Vehicle extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'brand_id',
        'name',
        'type',
        'price',
        'description',
        'status',
        'image',
        'location',
    ];

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('type', $category);
        });

        $query->when($filters['price'] ?? null, function ($query, $price) {
            if ($price === 'under_1m') {
                $query->where('price', '<', 1000000);
            } elseif ($price === 'above_2m') {
                $query->where('price', '>', 2000000);
            }
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if vehicle is available for the given date range
     */
    public function isAvailable(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate): bool
    {
        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();
    }

    /**
     * Get array of booked date ranges
     */
    public function getBookedDatesAttribute(): array
    {
        return $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where('end_date', '>=', now())
            ->get(['start_date', 'end_date'])
            ->map(fn($booking) => [
                'start' => $booking->start_date->format('Y-m-d'),
                'end' => $booking->end_date->format('Y-m-d'),
            ])
            ->toArray();
    }

    /**
     * Alias for isAvailable() - used by tests
     */
    public function isAvailableForDates(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate): bool
    {
        return $this->isAvailable($startDate, $endDate);
    }

    /**
     * Calculate number of days between two dates
     */
    public function getDaysCount(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate): int
    {
        return max(1, $startDate->diffInDays($endDate));
    }

    /**
     * Get the vehicle's image URL
     * Handles both external URLs and local paths
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/1.jpg'); // Default fallback image
        }

        // If it's an external URL (starts with http/https)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // For local images, check common locations
        // First try: public/images/ (current location)
        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }

        // Second try: storage/app/public/ (Laravel standard)
        if (file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        // Third try: assume it's a relative path from public/
        return asset($this->image);
    }

    /**
     * Get the indexable data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand?->name,
            'type' => $this->type,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }
}
