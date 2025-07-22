<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\ServiceDay;

class ServiceTimes extends Component
{
    public $services;

    public function mount()
    {
        // Fetch days with their times, ordered by weekday order
        $this->services = ServiceDay::with('times')
            ->orderByRaw("FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.service-times');
    }
}
