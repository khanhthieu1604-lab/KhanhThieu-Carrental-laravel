<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_can_view_vehicle_management_page()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/vehicles');

        $response->assertStatus(200);
        $response->assertViewIs('admin.vehicles.index');
    }

    /** @test */
    public function non_admin_cannot_access_vehicle_management()
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user);

        $response = $this->get('/admin/vehicles');

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_create_new_vehicle()
    {
        $this->actingAs($this->admin);

        $brand = Brand::factory()->create();

        $vehicleData = [
            'brand_id' => $brand->id,
            'name' => 'Toyota Camry 2024',
            'type' => 'Sedan',
            'price' => 800000,
            'description' => 'Luxury sedan for business',
            'status' => 'available',
            'location' => 'Hồ Chí Minh'
        ];

        $response = $this->post('/admin/vehicles', $vehicleData);

        $response->assertRedirect('/admin/vehicles');
        $this->assertDatabaseHas('vehicles', [
            'name' => 'Toyota Camry 2024',
            'brand_id' => $brand->id
        ]);
    }

    /** @test */
    public function admin_can_update_vehicle()
    {
        $this->actingAs($this->admin);

        $vehicle = Vehicle::factory()->create();

        $updateData = [
            'name' => 'Updated Vehicle Name',
            'price' => 1000000,
            'status' => 'maintenance'
        ];

        $response = $this->put("/admin/vehicles/{$vehicle->id}", array_merge(
            $vehicle->toArray(),
            $updateData
        ));

        $response->assertRedirect();
        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'name' => 'Updated Vehicle Name',
            'status' => 'maintenance'
        ]);
    }

    /** @test */
    public function admin_can_delete_vehicle()
    {
        $this->actingAs($this->admin);

        $vehicle = Vehicle::factory()->create();

        $response = $this->delete("/admin/vehicles/{$vehicle->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id
        ]);
    }

    /** @test */
    public function admin_cannot_delete_vehicle_with_active_bookings()
    {
        $this->actingAs($this->admin);

        $vehicle = Vehicle::factory()->create();
        \App\Models\Booking::factory()->create([
            'vehicle_id' => $vehicle->id,
            'status' => 'confirmed'
        ]);

        $response = $this->delete("/admin/vehicles/{$vehicle->id}");

        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id
        ]);
    }
}
