<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('fleet')->paginate(15);
        if (request()->wantsJson()) {
            return response()->json(['data' => $drivers]);
        }
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $driver, 'message' => 'Driver created successfully'], 201);
        }
        return redirect()->route('drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function show(Driver $driver)
    {
        if (request()->wantsJson()) {
            return response()->json(['data' => $driver]);
        }
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $driver, 'message' => 'Driver updated successfully']);
        }
        return redirect()->route('drivers.index')->with('success', 'Driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->deliveryOrders()->where('status', 'pending')->exists()) {
            if (request()->wantsJson()) {
                return response()->json(['message' => 'Cannot delete driver with pending delivery orders'], 422);
            }
            return redirect()->route('drivers.index')->with('error', 'Tidak dapat menghapus driver dengan pesanan pending.');
        }
        $driver->delete();
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Driver deleted successfully'], 200);
        }
        return redirect()->route('drivers.index')->with('success', 'Driver berhasil dihapus.');
    }
}
