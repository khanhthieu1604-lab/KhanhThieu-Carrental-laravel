<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvailabilityController extends Controller
{
    /**
     * Check vehicle availability for given date range
     */
    public function check(Request $request, $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        return response()->json([
            'available' => $vehicle->isAvailable($startDate, $endDate),
            'booked_dates' => $vehicle->booked_dates,
        ]);
    }

    /**
     * Get booked dates for calendar display
     */
    public function bookedDates($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        return response()->json([
            'booked_dates' => $vehicle->booked_dates,
        ]);
    }
}
