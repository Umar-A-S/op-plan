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
        $deliveryOrders = DeliveryOrder::with('driver', 'fleet')->paginate(20);
        if (request()->wantsJson()) {
            return response()->json(['data' => $deliveryOrders]);
        }
        return view('delivery-orders.index', compact('deliveryOrders'));
    }

    public function create()
    {
        return view('delivery-orders.create');
    }

    public function store(StoreDeliveryOrderRequest $request)
    {
        $order = DeliveryOrder::create($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $order, 'message' => 'Delivery order created successfully'], 201);
        }
        return redirect()->route('delivery-orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(DeliveryOrder $deliveryOrder)
    {
        if (request()->wantsJson()) {
            return response()->json(['data' => $deliveryOrder]);
        }
        return view('delivery-orders.show', compact('deliveryOrder'));
    }

    public function edit(DeliveryOrder $deliveryOrder)
    {
        return view('delivery-orders.edit', compact('deliveryOrder'));
    }

    public function update(UpdateDeliveryOrderRequest $request, DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->update($request->validated());
        if ($request->wantsJson()) {
            return response()->json(['data' => $deliveryOrder, 'message' => 'Delivery order updated successfully']);
        }
        return redirect()->route('delivery-orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(DeliveryOrder $deliveryOrder)
    {
        if ($deliveryOrder->status !== 'pending') {
            if (request()->wantsJson()) {
                return response()->json(['message' => 'Can only delete pending orders'], 422);
            }
            return redirect()->route('delivery-orders.index')->with('error', 'Hanya pesanan pending yang bisa dihapus.');
        }
        $deliveryOrder->delete();
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Delivery order deleted successfully'], 200);
        }
        return redirect()->route('delivery-orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function myOrders()
    {
        $driver = auth()->user()->driver;
        if (!$driver) {
            return response()->json(['message' => 'User is not a driver'], 403);
        }
        $orders = DeliveryOrder::where('driver_id', $driver->id)->paginate(20);
        if (request()->wantsJson()) {
            return response()->json(['data' => $orders]);
        }
        return view('my-orders.index', compact('orders'));
    }

    public function updateLocation(Request $request, DeliveryOrder $order)
    {
        $driver = auth()->user()->driver;
        if (!$driver || $order->driver_id !== $driver->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $order->update($request->only('latitude', 'longitude'));
        return response()->json(['message' => 'Location updated']);
    }

    public function uploadPod(Request $request, DeliveryOrder $order)
    {
        $driver = auth()->user()->driver;
        if (!$driver || $order->driver_id !== $driver->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate(['pod_image' => 'required|image|max:2048']);
        $path = $request->file('pod_image')->store('pod', 'public');
        
        $order->update(['pod_image_path' => $path]);
        return response()->json(['message' => 'POD uploaded', 'path' => $path]);
    }
}
