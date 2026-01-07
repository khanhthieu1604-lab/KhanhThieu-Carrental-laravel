<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

       protected $fillable = [
        'vehicle_id',
        'user_id',
        'start_date',
        'end_date',
        'total_days', 
        'total_price',
        'status'
    ];

   
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}