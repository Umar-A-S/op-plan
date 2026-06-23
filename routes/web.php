<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\ReportController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Logistik & Manager Routes - Full Access
Route::middleware(['auth', 'role:Admin Logistik|Manager'])->group(function () {
    Route::resource('fleets', FleetController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('delivery-orders', DeliveryOrderController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
});

// Driver Routes - View Own Orders
Route::middleware(['auth', 'role:Driver'])->group(function () {
    Route::get('my-orders', [DeliveryOrderController::class, 'myOrders'])->name('delivery-orders.mine');
    Route::patch('delivery-orders/{id}/status', [DeliveryOrderController::class, 'updateStatus'])->name('delivery-orders.update-status');
});

require __DIR__.'/auth.php';
