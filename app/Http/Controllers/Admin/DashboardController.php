<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        

        
        $totalVehicles = Vehicle::count();

        
        $totalUsers = User::where('role', '!=', 'admin')->count();
        
        
        $pendingBookings = Booking::where('status', 'pending')->count();

        
        $revenue = Booking::whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');

        
        $recentBookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();

        

        
        $availableCars = Vehicle::where('status', 'available')->count();

        
        $rentedCars = Vehicle::where('status', '!=', 'available')->count();

        
        return view('admin.dashboard', compact(
            'totalVehicles', 
            'totalUsers', 
            'pendingBookings', 
            'revenue', 
            'recentBookings',
            'availableCars',
            'rentedCars'
        ));
    }

    
    public function apiStats()
    {
        
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized: Bạn không phải Admin'
            ], 403);
        }

        
        return response()->json([
            'status' => 'success',
            'data' => [
                
                'total_vehicles'   => Vehicle::count(),

                
                'total_bookings'   => Booking::count(),

                
                'pending_bookings' => Booking::where('status', 'pending')->count(),

                
                'total_revenue'    => Booking::where('status', 'completed')
                    ->sum('total_price'),
            ]
        ]);
    }
}
