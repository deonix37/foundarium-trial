<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'cars', 
    CarController::class,
);
Route::apiResource(
    'drivers',
    DriverController::class,
    ['except' => 'update'],
);
