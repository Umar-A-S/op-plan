<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use App\Models\Driver;
use Livewire\Component;
use Livewire\WithPagination;

class AssignDriver extends Component
{
    use WithPagination;

    public $selectedDriver = [];

    public function assign($orderId)
    {
        $order = DeliveryOrder::findOrFail($orderId);
        $driverId = $this->selectedDriver[$orderId] ?? null;

        if ($driverId) {
            $order->update([
                'driver_id' => $driverId,
                'status' => 'assigned'
            ]);
            
            Driver::find($driverId)->update(['status' => 'assigned']);
            
            session()->flash('message', 'Driver assigned successfully.');
        }
    }

    public function render()
    {
        return view('livewire.assign-driver', [
            'orders' => DeliveryOrder::whereIn('status', ['pending', 'assigned'])->paginate(10),
            'availableDrivers' => Driver::where('status', 'available')->get(),
        ]);
    }
}
