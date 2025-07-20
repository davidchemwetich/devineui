<?php

namespace App\Livewire\Frontend;

use App\Models\AboutUs;
use Livewire\Component;

class AboutHome extends Component
{
    public $about;

    public function mount()
    {
        $this->about = AboutUs::first();
    }

    public function render()
    {
        return view('livewire.frontend.about-home');
    }
}
