<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), 
            'role' => 'admin',
        ]);

        
        User::factory()->create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        
        $this->call([
            VehicleSeeder::class,
            
        ]);
        \App\Models\Vehicle::factory(100)->create();
    }


    

}