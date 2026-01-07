<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => 'User ' . Str::random(5),
            'email' => Str::random(10).'@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), 
            'remember_token' => Str::random(10),
            'role' => 'customer',
            'phone' => '09' . rand(10000000, 99999999),
            'address' => 'Địa chỉ mẫu, Việt Nam',
        ];
    }
}