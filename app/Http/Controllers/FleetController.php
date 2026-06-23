<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Http\Requests\StoreFleetRequest;
use App\Http\Requests\UpdateFleetRequest;

class FleetController extends Controller
{
    public function index()
    {
        $fleets = Fleet::with('drivers', 'deliveryOrders')->paginate(15);
        if (request()->wantsJson()) {
            return response()->json(['data' => $fleets]);
        }
        return view('fleets.index', compact('fleets'));
    }

    public function create()
    {
        return view('fleets.create');
    }

    public function store(StoreFleetRequest $request)
    {
        $fleet = Fleet::create($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $fleet, 'message' => 'Fleet created successfully'], 201);
        }
        return redirect()->route('fleets.index')->with('success', 'Armada berhasil ditambahkan.');
    }

    public function show(Fleet $fleet)
    {
        if (request()->wantsJson()) {
            return response()->json(['data' => $fleet]);
        }
        return view('fleets.show', compact('fleet'));
    }

    public function edit(Fleet $fleet)
    {
        return view('fleets.edit', compact('fleet'));
    }

    public function update(UpdateFleetRequest $request, Fleet $fleet)
    {
        $fleet->update($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $fleet, 'message' => 'Fleet updated successfully']);
        }
        return redirect()->route('fleets.index')->with('success', 'Armada berhasil diperbarui.');
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Fleet deleted successfully'], 200);
        }
        return redirect()->route('fleets.index')->with('success', 'Armada berhasil dihapus.');
    }
}
