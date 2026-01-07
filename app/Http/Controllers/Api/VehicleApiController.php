<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    
    public function index()
    {
        
        $vehicles = Vehicle::where('status', 'available')
            ->latest()
            ->get();

        
        return response()->json([
            'status'  => 200,
            'message' => 'Lấy danh sách xe thành công',
            'data'    => $vehicles
        ]);
    }

    
    public function show($id)
    {
        
        $vehicle = Vehicle::find($id);

        
        if (!$vehicle) {
            return response()->json([
                'message' => 'Không tìm thấy xe'
            ], 404);
        }

        
        return response()->json([
            'data' => $vehicle
        ]);
    }
}
