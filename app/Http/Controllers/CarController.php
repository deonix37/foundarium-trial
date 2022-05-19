<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
{
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        $car = Car::create();

        return response()->json($car, 201, [
            'Location' => route('cars.show', $car),
        ]);
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function update(Request $request, Car $car)
    {
        try {
            $data = $request->validate([
                'driver_id' => ['nullable', 'integer', 'unique:cars'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }

        $car->update($data);

        return $car;
    }

    public function destroy(Car $car)
    {
        $car->delete();
    }
}
