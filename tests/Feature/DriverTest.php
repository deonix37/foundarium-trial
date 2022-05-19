<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_access_drivers()
    {
        Driver::factory(10)->create();

        $this->get(route('drivers.index'))
            ->assertJsonCount(10);
    }

    public function test_can_create_driver()
    {
        $this->post(route('drivers.store'))
            ->assertStatus(201)
            ->assertHeader(
                'Location',
                route('drivers.show', Driver::latest()->first()),
            );
    }

    public function test_can_access_driver()
    {
        $driver = Driver::factory()->create();

        $this->get(route('drivers.show', $driver))
            ->assertStatus(200)
            ->assertJson(['id' => $driver->id]);
    }

    public function test_can_delete_driver()
    {
        $driver = Driver::factory()->create();

        $this->delete(route('drivers.show', $driver))
            ->assertStatus(200);
    }
}
