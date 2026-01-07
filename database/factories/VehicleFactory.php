<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    public function definition()
    {
        
        $types = ['Sedan', 'SUV', 'Truck', 'Hatchback', 'Crossover'];
        
        
        $brand = Brand::inRandomOrder()->first(); 
        if (!$brand) {
            $brand = Brand::factory()->create(); 
        }

        return [
            'name' => $brand->name . ' ' . $this->faker->word . ' ' . $this->faker->year, 
            'brand_id' => $brand->id,
            'type' => $this->faker->randomElement($types),
            'price' => $this->faker->numberBetween(500, 5000) * 1000, 
            'image' => 'https://placehold.co/600x400?text=Car+' . $this->faker->randomNumber(2), 
            'status' => 'available', 
            'description' => $this->faker->paragraph(2), 
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}