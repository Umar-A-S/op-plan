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
        return response()->json(['data' => $fleets]);
    }

    public function create()
    {
        return response()->json(['message' => 'Create form']);
    }

    public function store(StoreFleetRequest $request)
    {
        $fleet = Fleet::create($request->validated());
        return response()->json(['data' => $fleet, 'message' => 'Fleet created successfully'], 201);
    }

    public function show(Fleet $fleet)
    {
        $fleet->load('drivers', 'deliveryOrders');
        return response()->json(['data' => $fleet]);
    }

    public function edit(Fleet $fleet)
    {
        return response()->json(['data' => $fleet, 'message' => 'Edit form']);
    }

    public function update(UpdateFleetRequest $request, Fleet $fleet)
    {
        $fleet->update($request->validated());
        return response()->json(['data' => $fleet, 'message' => 'Fleet updated successfully']);
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return response()->json(['message' => 'Fleet deleted successfully'], 200);
    }
}
