<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function vehicle_is_available_when_no_bookings_exist()
    {
        $vehicle = Vehicle::factory()->create(['status' => 'available']);

        $startDate = now()->addDays(1);
        $endDate = now()->addDays(3);

        $this->assertTrue($vehicle->isAvailableForDates($startDate, $endDate));
    }

    /** @test */
    public function vehicle_is_not_available_during_existing_booking()
    {
        $vehicle = Vehicle::factory()->create(['status' => 'available']);

        // Existing booking from day 2 to day 5
        Booking::factory()->create([
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(2),
            'end_date' => now()->addDays(5),
            'status' => 'confirmed'
        ]);

        // Try to book from day 3 to day 4 (overlaps)
        $startDate = now()->addDays(3);
        $endDate = now()->addDays(4);

        $this->assertFalse($vehicle->isAvailableForDates($startDate, $endDate));
    }

    /** @test */
    public function vehicle_is_available_between_bookings()
    {
        $vehicle = Vehicle::factory()->create(['status' => 'available']);

        // Booking 1: Day 1 to Day 3
        Booking::factory()->create([
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(3),
            'status' => 'confirmed'
        ]);

        // Booking 2: Day 7 to Day 10
        Booking::factory()->create([
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'confirmed'
        ]);

        // Try to book from Day 4 to Day 6 (available gap)
        $startDate = now()->addDays(4);
        $endDate = now()->addDays(6);

        $this->assertTrue($vehicle->isAvailableForDates($startDate, $endDate));
    }

    /** @test */
    public function cancelled_bookings_do_not_affect_availability()
    {
        $vehicle = Vehicle::factory()->create(['status' => 'available']);

        // Cancelled booking
        Booking::factory()->create([
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(2),
            'end_date' => now()->addDays(5),
            'status' => 'cancelled'
        ]);

        $startDate = now()->addDays(3);
        $endDate = now()->addDays(4);

        $this->assertTrue($vehicle->isAvailableForDates($startDate, $endDate));
    }
}
