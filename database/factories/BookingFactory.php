<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+30 days');
        $endDate = fake()->dateTimeBetween($startDate, '+60 days');

        $days = max(1, (int) date_diff(
            \DateTime::createFromFormat('U', $startDate->getTimestamp()),
            \DateTime::createFromFormat('U', $endDate->getTimestamp())
        )->days);

        $pricePerDay = fake()->numberBetween(300000, 1500000);
        $totalPrice = $days * $pricePerDay;

        return [
            'user_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'note' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the booking is pending.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the booking is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    /**
     * Indicate that the booking is completed.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the booking is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}
