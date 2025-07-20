<?php

namespace App\Livewire\Frontend;

use App\Models\Church;
use Livewire\Component;

class ChurchNear extends Component
{
    public $churches;

    public function mount()
    {
        // Get churches from the database
        // Only selecting the fields needed based on your requirement
        $this->churches = Church::select('name', 'thumbnail', 'address', 'phone')
            ->orderByName()
            ->limit(5)  // Show only 5 churches
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.frontend.church-near');
    }
}