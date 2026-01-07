<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->paginate(15);

        
        return view('admin.bookings.index', compact('bookings'));
    }

    
    public function updateStatus(Request $request, $id)
    {
        
        
        $booking = Booking::with('vehicle')->findOrFail($id);
        
        
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        
        $booking->update([
            'status' => $request->status
        ]);

        
        if ($request->status === 'confirmed') {
            $booking->vehicle->update([
                'status' => 'rented'
            ]);
        } elseif (in_array($request->status, ['completed', 'cancelled'])) {
            $booking->vehicle->update([
                'status' => 'available'
            ]);
        }

        
        return back()->with('success', 'Đã cập nhật đơn hàng và trạng thái xe thành công!');
    }
}
