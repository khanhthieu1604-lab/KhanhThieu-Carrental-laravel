<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function store(Request $request)
    {
        
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:500',
        ]);

        
        $booking = Booking::findOrFail($request->booking_id);

        
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        
        $exists = Review::where('booking_id', $booking->id)->exists();
        if ($exists) {
            return back()->with(
                'error',
                'Bạn đã đánh giá chuyến đi này rồi!'
            );
        }

        
        Review::create([
            'user_id'    => Auth::id(),
            'vehicle_id' => $booking->vehicle_id,
            'booking_id' => $booking->id,
            'rating'     => $request->rating,
            'comment'    => $request->comment
        ]);

        
        return back()->with(
            'success',
            'Cảm ơn bạn đã đánh giá!'
        );
    }
}
