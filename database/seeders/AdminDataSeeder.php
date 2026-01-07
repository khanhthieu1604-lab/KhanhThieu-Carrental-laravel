<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Maintenance;
use App\Models\Brand; 
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    public function run(): void
    {
        
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
                'phone' => '0909123456',
                'address' => 'Trụ sở chính Thiuu Rental',
                'email_verified_at' => now(),
            ]
        );

        
        $brand = Brand::firstOrCreate(
            ['name' => 'Mercedes-Benz'],
            ['image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/1024px-Mercedes-Logo.svg.png']
        );

        
        $car = Vehicle::create([
            'name' => 'Mercedes-Benz C200',
            'brand_id' => $brand->id, 
            'type' => 'Sedan',
            'price' => 2700000, 
            'status' => 'available',
            'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=2070&auto=format&fit=crop',
            'description' => 'Dòng xe sang trọng, đẳng cấp dành cho doanh nhân.'
        ]);

        
        Booking::create([
            'user_id' => $admin->id,
            'vehicle_id' => $car->id,
            'start_date' => now(),
            'end_date' => now()->addDays(2),
            'total_price' => 5400000,
            'status' => 'confirmed', 
            'note' => 'Giao xe đúng giờ tại sân bay Tân Sơn Nhất'
        ]);

        
        if (class_exists(Maintenance::class)) {
            Maintenance::create([
                'vehicle_id' => $car->id,
                'type' => 'Bảo dưỡng định kỳ',
                'cost' => 1200000,
                'maintenance_date' => now()->subDays(5),
                'description' => 'Thay nhớt định kỳ tại Mercedes Vietnam.'
            ]);
        }
    }
}