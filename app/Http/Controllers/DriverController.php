<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('fleet', 'deliveryOrders', 'user')->paginate(15);
        return response()->json(['data' => $drivers]);
    }

    public function create()
    {
        return response()->json(['message' => 'Create form']);
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->validated());
        return response()->json(['data' => $driver, 'message' => 'Driver created successfully'], 201);
    }

    public function show(Driver $driver)
    {
        $driver->load('fleet', 'deliveryOrders', 'user');
        return response()->json(['data' => $driver]);
    }

    public function edit(Driver $driver)
    {
        return response()->json(['data' => $driver, 'message' => 'Edit form']);
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated());
        return response()->json(['data' => $driver, 'message' => 'Driver updated successfully']);
    }

    public function destroy(Driver $driver)
    {
        if ($driver->deliveryOrders()->where('status', 'pending')->exists()) {
            return response()->json(['message' => 'Cannot delete driver with pending delivery orders'], 422);
        }
        $driver->delete();
        return response()->json(['message' => 'Driver deleted successfully'], 200);
    }
}
