<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_access_cars()
    {
        Car::factory(10)->create();

        $this->get(route('cars.index'))
            ->assertJsonCount(10);
    }

    public function test_can_create_car()
    {
        $this->post(route('cars.store'))
            ->assertStatus(201)
            ->assertHeader(
                'Location',
                route('cars.show', Car::latest()->first()),
            );
    }

    public function test_can_access_car()
    {
        $car = Car::factory()->create();

        $this->get(route('cars.show', $car))
            ->assertStatus(200)
            ->assertJson(['id' => $car->id]);
    }

    public function test_can_set_driver()
    {
        $driver = Driver::factory()->create();
        $car = Car::factory()->create();

        $this->put(route('cars.show', $car), ['driver_id' => $driver->id]);
        $this->get(route('cars.show', $car))
            ->assertJson(['driver_id' => $driver->id]);
    }

    public function test_can_unset_driver()
    {
        $driver = Driver::factory()->create();
        $car = Car::factory()->create(['driver_id' => $driver->id]);

        $this->put(route('cars.show', $car), ['driver_id' => null]);
        $this->get(route('cars.show', $car))
            ->assertJson(['driver_id' => null]);
    }

    public function test_cannot_set_taken_driver()
    {
        $driver = Driver::factory()->create();
        $car = Car::factory()->create();
        $car_2 = Car::factory()->create();

        $this->put(route('cars.show', $car), [
            'driver_id' => $driver->id,
        ]);
        $this->put(route('cars.show', $car_2), [
            'driver_id' => $driver->id,
        ])->assertStatus(400);
    }

    public function test_can_delete_car()
    {
        $car = Car::factory()->create();

        $this->delete(route('cars.show', $car))
            ->assertStatus(200);
    }
}
