<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleCategory;

class VehicleCategorySeeder extends Seeder
{
    public function run(): void
    {
        VehicleCategory::create([
            'name' => 'Sedan',
            'description' => 'Xe sedan 4 chỗ'
        ]);

        VehicleCategory::create([
            'name' => 'SUV',
            'description' => 'Xe SUV gầm cao'
        ]);
    }
}
