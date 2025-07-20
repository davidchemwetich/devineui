<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;
use App\Models\AboutUs;


class Aboutsite extends Component
{
    public AboutUs $aboutUs;
    
    public function mount()
    {
        $this->aboutUs = AboutUs::first() ?? new AboutUs();
    }
    
    public function render()
    {
        return view('livewire.frontend.settings.aboutsite')
        ->layout('front.layouts.front-layout');
    }
}




