<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_search_vehicles_by_name()
    {
        Vehicle::factory()->create(['name' => 'Toyota Camry']);
        Vehicle::factory()->create(['name' => 'Honda Civic']);
        Vehicle::factory()->create(['name' => 'Mercedes Benz']);

        $response = $this->get('/search?q=toyota');

        $response->assertStatus(200);
        $response->assertSee('Toyota Camry');
        $response->assertDontSee('Honda Civic');
    }

    /** @test */
    public function can_filter_vehicles_by_brand()
    {
        $toyota = Vehicle::factory()->create(['brand_id' => 1]);
        $honda = Vehicle::factory()->create(['brand_id' => 2]);

        $response = $this->get('/vehicles?brand=1');

        $response->assertStatus(200);
        $this->assertTrue($response->viewData('vehicles')->contains($toyota));
        $this->assertFalse($response->viewData('vehicles')->contains($honda));
    }

    /** @test */
    public function can_filter_vehicles_by_price_range()
    {
        Vehicle::factory()->create(['price_per_day' => 300000]);
        $affordable = Vehicle::factory()->create(['price_per_day' => 500000]);
        Vehicle::factory()->create(['price_per_day' => 1000000]);

        $response = $this->get('/vehicles?min_price=400000&max_price=600000');

        $response->assertStatus(200);
        $this->assertEquals(1, $response->viewData('vehicles')->count());
        $this->assertTrue($response->viewData('vehicles')->contains($affordable));
    }
}
