<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\SiteSetting;

class Header extends Component
{
    public function render()
    {
        $settings = SiteSetting::first();
        $favicon = $settings->favicon ?? null;

        return view('livewire.frontend.header',compact('favicon'));
    }
}
