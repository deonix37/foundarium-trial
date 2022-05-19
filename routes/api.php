<?php

use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'drivers',
    DriverController::class,
    ['except' => 'update'],
);
