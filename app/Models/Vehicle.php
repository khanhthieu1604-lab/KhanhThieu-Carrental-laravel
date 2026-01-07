<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'type',
        'price',
        'description',
        'status',
        'image', 
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

    public function brand() { return $this->belongsTo(Brand::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}