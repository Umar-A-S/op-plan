<?php

namespace App\Livewire;

use App\Models\Fleet;
use App\Models\Driver;
use App\Models\DeliveryOrder;
use Livewire\Component;

class DashboardStats extends Component
{
    // Poll every 30 seconds
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.dashboard-stats', [
            'totalFleets' => Fleet::count(),
            'activeFleets' => Fleet::where('status', 'active')->count(),
            'totalDrivers' => Driver::count(),
            'availableDrivers' => Driver::where('status', 'available')->count(),
            'totalOrders' => DeliveryOrder::count(),
            'pendingOrders' => DeliveryOrder::where('status', 'pending')->count(),
        ]);
    }
}
