<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'vehicle_id'       => 'required|exists:vehicles,id',
            'type'             => 'required|string|max:255',
            'cost'             => 'required|numeric|min:0',
            'maintenance_date' => 'required|date',
            'description'      => 'nullable|string|max:1000',
        ]);

        
        Maintenance::create($validated);

        
        return redirect()->back()
            ->with('success', 'Đã thêm lịch sử bảo trì thành công!');
    }

    
    public function destroy($id)
    {
        
        $maintenance = Maintenance::findOrFail($id);

        
        $maintenance->delete();

        
        return redirect()->back()
            ->with('success', 'Đã xóa bản ghi bảo trì thành công.');
    }
}
