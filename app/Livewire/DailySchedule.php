<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use Livewire\Component;
use Livewire\WithPagination;

class DailySchedule extends Component
{
    use WithPagination;

    public $date;
    public $filterType = 'today'; // today, yesterday, all, custom

    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function setFilter($type)
    {
        $this->filterType = $type;
        $this->resetPage();

        if ($type === 'today') {
            $this->date = date('Y-m-d');
        } elseif ($type === 'yesterday') {
            $this->date = date('Y-m-d', strtotime('yesterday'));
        }
    }

    public function clearFilter()
    {
        $this->filterType = 'today';
        $this->date = date('Y-m-d');
        $this->resetPage();
    }

    public function render()
    {
        $query = DeliveryOrder::with(['driver', 'fleet']);

        if ($this->filterType !== 'all') {
            $query->whereDate('scheduled_delivery', $this->date);
        }

        return view('livewire.daily-schedule', [
            'orders' => $query->paginate(10),
        ]);
    }
}
