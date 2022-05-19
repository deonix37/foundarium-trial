<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return Driver::all();
    }

    public function store(Request $request)
    {
        $driver = Driver::create();

        return response()->json($driver, 201, [
            'Location' => route('drivers.show', $driver),
        ]);
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
    }
}
