<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    public function run(): void
    {
        
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], 
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('12345678'), 
                'role'     => 'admin', 
                'phone'    => '0909999999',
                'address'  => 'Trụ sở chính Thiuu Rental'
            ]
        );
    }
}