<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleBookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_available_vehicles()
    {
        // Create test vehicles
        Vehicle::factory()->count(5)->create(['status' => 'available']);
        Vehicle::factory()->create(['status' => 'maintenance']);

        $response = $this->get('/vehicles');

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.index');
        $response->assertViewHas('vehicles');

        // Should show 5 available vehicles, not the one in maintenance
        $this->assertEquals(5, $response->viewData('vehicles')->count());
    }

    /** @test */
    public function authenticated_user_can_create_booking()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['status' => 'available', 'price_per_day' => 500000]);

        $this->actingAs($user);

        $bookingData = [
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(1)->format('Y-m-d'),
            'end_date' => now()->addDays(3)->format('Y-m-d'),
            'pickup_location' => 'Sân bay Tân Sơn Nhất',
            'notes' => 'Test booking'
        ];

        $response = $this->post('/bookings', $bookingData);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function guest_cannot_create_booking()
    {
        $vehicle = Vehicle::factory()->create();

        $bookingData = [
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(1)->format('Y-m-d'),
            'end_date' => now()->addDays(3)->format('Y-m-d'),
        ];

        $response = $this->post('/bookings', $bookingData);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function booking_calculates_total_price_correctly()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create([
            'status' => 'available',
            'price_per_day' => 500000
        ]);

        $this->actingAs($user);

        $startDate = now()->addDays(1);
        $endDate = now()->addDays(4); // 3 days rental

        $bookingData = [
            'vehicle_id' => $vehicle->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'pickup_location' => 'Test Location'
        ];

        $this->post('/bookings', $bookingData);

        $booking = Booking::latest()->first();

        // 3 days * 500,000 = 1,500,000
        $this->assertEquals(1500000, $booking->total_price);
    }

    /** @test */
    public function cannot_book_unavailable_vehicle()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['status' => 'rented']);

        $this->actingAs($user);

        $bookingData = [
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDays(1)->format('Y-m-d'),
            'end_date' => now()->addDays(3)->format('Y-m-d'),
            'pickup_location' => 'Test Location'
        ];

        $response = $this->post('/bookings', $bookingData);

        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('bookings', [
            'vehicle_id' => $vehicle->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function user_can_view_their_booking_history()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        // Create bookings for the user
        Booking::factory()->count(3)->create(['user_id' => $user->id]);

        // Create booking for other user (should not be visible)
        Booking::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($user);

        $response = $this->get('/bookings/history');

        $response->assertStatus(200);
        $this->assertEquals(3, $response->viewData('bookings')->count());
    }

    /** @test */
    public function user_can_cancel_pending_booking()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        $this->actingAs($user);

        $response = $this->delete("/bookings/{$booking->id}");

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled'
        ]);
    }

    /** @test */
    public function user_cannot_cancel_confirmed_booking()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'confirmed'
        ]);

        $this->actingAs($user);

        $response = $this->delete("/bookings/{$booking->id}");

        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed' // Should remain unchanged
        ]);
    }
}
