<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Vehicle;
use Carbon\Carbon;

class RentalController extends Controller
{
    
    public function index()
    {
        
        $rentals = Rental::with('vehicle')
            ->where('user_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rentals.index', compact('rentals'));
    }

    
    public function store(Request $request, $id)
    {
        
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ], [
            'start_date.after_or_equal' => 'Ngày nhận xe không được chọn trong quá khứ.',
            'end_date.after'            => 'Ngày trả xe phải sau ngày nhận xe.',
        ]);

        
        $vehicle = Vehicle::findOrFail($id);

        
        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        
        $days = $start->diffInDays($end);
        if ($days < 1) {
            $days = 1;
        }

        
        $totalPrice = $days * $vehicle->rent_price_per_day;

        try {
            
            Rental::create([
                'vehicle_id'  => $vehicle->id,
                'user_id'     => 1,
                'start_date'  => $request->start_date,
                'end_date'    => $request->end_date,
                'total_days'  => $days,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            
            return redirect()
                ->route('rentals.index')
                ->with('success', 'Đã gửi yêu cầu thuê xe thành công!');

        } catch (\Exception $e) {
            
            return redirect()
                ->back()
                ->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
