<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DeliveryOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Logistik Routes - Full Access
Route::middleware(['auth', 'role:Admin Logistik'])->group(function () {
    Route::resource('fleets', FleetController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('delivery-orders', DeliveryOrderController::class);
});

// Manager Routes - Limited Access
Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('fleets', [FleetController::class, 'index'])->name('fleets.index');
    Route::get('fleets/{id}', [FleetController::class, 'show'])->name('fleets.show');

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('drivers/{id}', [DriverController::class, 'show'])->name('drivers.show');

    Route::resource('delivery-orders', DeliveryOrderController::class);
    Route::post('delivery-orders/{id}/assign', [DeliveryOrderController::class, 'assign'])->name('delivery-orders.assign');
});

// Driver Routes - View Own Orders
Route::middleware(['auth', 'role:Driver'])->group(function () {
    Route::get('my-orders', [DeliveryOrderController::class, 'myOrders'])->name('delivery-orders.mine');
    Route::get('delivery-orders/{id}', [DeliveryOrderController::class, 'show'])->name('delivery-orders.show');
    Route::patch('delivery-orders/{id}/status', [DeliveryOrderController::class, 'updateStatus'])->name('delivery-orders.update-status');
});
