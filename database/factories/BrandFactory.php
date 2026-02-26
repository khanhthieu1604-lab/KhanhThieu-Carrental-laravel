<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            'Toyota',
            'Honda',
            'Mercedes-Benz',
            'BMW',
            'Audi',
            'Lexus',
            'Mazda',
            'Ford',
            'Nissan',
            'Hyundai',
            'Kia',
            'Volkswagen',
            'Chevrolet',
            'Peugeot',
            'Vinfast'
        ];

        return [
            'name' => fake()->unique()->randomElement($brands),
            'image' => 'brands/' . strtolower(fake()->word()) . '.png',
        ];
    }
}
