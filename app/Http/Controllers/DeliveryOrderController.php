<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Http\Requests\StoreDeliveryOrderRequest;
use App\Http\Requests\UpdateDeliveryOrderRequest;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $orders = DeliveryOrder::with('driver', 'fleet')->paginate(20);
        return response()->json(['data' => $orders]);
    }

    public function create()
    {
        return response()->json(['message' => 'Create form']);
    }

    public function store(StoreDeliveryOrderRequest $request)
    {
        $data = $request->validated();
        $order = DeliveryOrder::create($data);
        return response()->json(['data' => $order, 'message' => 'Delivery order created successfully'], 201);
    }

    public function show(DeliveryOrder $order)
    {
        $order->load('driver', 'fleet');
        return response()->json(['data' => $order]);
    }

    public function edit(DeliveryOrder $order)
    {
        return response()->json(['data' => $order, 'message' => 'Edit form']);
    }

    public function update(UpdateDeliveryOrderRequest $request, DeliveryOrder $order)
    {
        $order->update($request->validated());
        return response()->json(['data' => $order, 'message' => 'Delivery order updated successfully']);
    }

    public function destroy(DeliveryOrder $order)
    {
        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Can only delete pending orders'], 422);
        }
        $order->delete();
        return response()->json(['message' => 'Delivery order deleted successfully'], 200);
    }

    public function myOrders()
    {
        $driver = auth()->user()->driver;
        if (!$driver) {
            return response()->json(['message' => 'User is not a driver'], 403);
        }
        $orders = DeliveryOrder::where('driver_id', $driver->id)
            ->with('fleet')
            ->paginate(20);
        return response()->json(['data' => $orders]);
    }

    public function updateStatus(Request $request, DeliveryOrder $order)
    {
        $driver = auth()->user()->driver;
        if (!$driver || $order->driver_id !== $driver->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate(['status' => 'required|in:pending,assigned,in_transit,delivered,failed']);
        $order->update(['status' => $request->input('status')]);
        return response()->json(['data' => $order, 'message' => 'Status updated successfully']);
    }
}
