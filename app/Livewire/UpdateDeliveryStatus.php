<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use Livewire\Component;

use Livewire\WithFileUploads;

class UpdateDeliveryStatus extends Component
{
    use WithFileUploads;

    public DeliveryOrder $order;
    public $status;
    public $podImage;

    public function mount(DeliveryOrder $order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function updateStatus()
    {
        $rules = ['status' => 'required|in:in_transit,delivered,failed'];
        if ($this->status === 'delivered') {
            $rules['podImage'] = 'required|image|max:2048';
        }
        $this->validate($rules);

        $data = ['status' => $this->status];
        if ($this->podImage) {
            $data['pod_image_path'] = $this->podImage->store('pod', 'public');
        }

        $this->order->update($data);

        session()->flash('message', 'Status updated successfully.');
    }

    public function render()
    {
        return view('livewire.update-delivery-status');
    }
}
