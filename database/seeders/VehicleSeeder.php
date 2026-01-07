<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('vehicles')->truncate();
        DB::table('brands')->truncate();
        Schema::enableForeignKeyConstraints();

        $now = Carbon::now();

        $brands = [
            ['id' => 1, 'name' => 'Mercedes-Benz'],
            ['id' => 2, 'name' => 'BMW'],
            ['id' => 3, 'name' => 'Porsche'],
            ['id' => 4, 'name' => 'Audi'],
            ['id' => 5, 'name' => 'Lamborghini'],
            ['id' => 6, 'name' => 'Ferrari'],
            ['id' => 7, 'name' => 'Rolls-Royce'],
            ['id' => 8, 'name' => 'Bentley'],
            ['id' => 9, 'name' => 'McLaren'],
            ['id' => 10, 'name' => 'Aston Martin'],
        ];
        
        foreach ($brands as &$b) { $b['created_at'] = $now; $b['updated_at'] = $now; }
        DB::table('brands')->insert($brands);

        
        $carImageIds = [
            '1618843479313-40f8afb4b4d8', '1525609004556-c46c7d6cf048', '1503376763036-066120622c74',
            '1580273916550-e323be2ae537', '1494976388531-d1058494cdd8', '1552519507-da3b142c6e3d',
            '1617788138017-80ad40651399', '1544636331-e26879cd4d9b', '1603584173870-7f23fdae1b7a',
            '1631295868223-63265b40d9e4', '1614162692292-7ac56d7f7f1e', '1553440569-bcc63803a83d'
        ];

        $carModels = [
            1 => ['S-Class', 'G63', 'Maybach'], 2 => ['M8', 'X7', 'i7'],
            3 => ['911 GT3', 'Taycan', 'Cayenne'], 4 => ['R8', 'RS7', 'e-tron'],
            5 => ['Revuelto', 'Urus'], 6 => ['SF90', 'Roma'],
            7 => ['Phantom', 'Cullinan'], 8 => ['Continental GT'],
            9 => ['750S', 'Senna'], 10 => ['Valhalla', 'Vantage']
        ];

        for ($i = 1; $i <= 100; $i++) {
            $brandId = rand(1, 10);
            $modelName = $carModels[$brandId][array_rand($carModels[$brandId])];
            $brandName = $brands[$brandId - 1]['name'];
            
            
            $randomImgId = $carImageIds[array_rand($carImageIds)];

            $vehicles[] = [
                'name' => $brandName . ' ' . $modelName . ' #' . Str::upper(Str::random(4)),
                'brand_id' => $brandId,
                'type' => 'Elite',
                'price' => rand(50, 300) * 100000,
                
                'image' => "https://images.unsplash.com/photo-{$randomImgId}?auto=format&fit=crop&q=80&w=800",
                'description' => "Dòng xe siêu sang $modelName.",
                'status' => 'available',
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($vehicles) >= 20) {
                DB::table('vehicles')->insert($vehicles);
                $vehicles = [];
            }
        }
    }
}