<?php

namespace App\Livewire\Shield\Mobile;

use Livewire\Component;

class Settings extends Component
{
    public function render()
    {
        return view('livewire.shield.mobile.settings') 
            ->layout('shield.layouts.shield');
    }
}
