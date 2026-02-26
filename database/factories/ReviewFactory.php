<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
            'booking_id' => Booking::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(2),
        ];
    }

    /**
     * Indicate a 5-star review.
     */
    public function excellent(): static
    {
        return $this->state(fn(array $attributes) => [
            'rating' => 5,
            'comment' => 'Xe rất tốt, dịch vụ tuyệt vời! Chắc chắn sẽ quay lại.',
        ]);
    }

    /**
     * Indicate a poor review.
     */
    public function poor(): static
    {
        return $this->state(fn(array $attributes) => [
            'rating' => fake()->numberBetween(1, 2),
            'comment' => 'Không hài lòng với dịch vụ.',
        ]);
    }
}
