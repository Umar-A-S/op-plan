<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DeliveryOrderController;

Route::get('/', function () {
    return view('welcome');
});

// Fleet Management Routes
Route::resource('fleets', FleetController::class);

// Driver Management Routes
Route::resource('drivers', DriverController::class);

// Delivery Order Processing Routes
Route::resource('delivery-orders', DeliveryOrderController::class);
