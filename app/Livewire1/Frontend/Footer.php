<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\SiteSetting;

class Footer extends Component
{
    public $settings;
    public $socialLinks = [];

    public function mount()
    {
        $this->settings = SiteSetting::first();

        $siteSettings = SiteSetting::first();
        
        if ($siteSettings) {
            $this->socialLinks = $siteSettings->social_links ?? [];
        }
    }

    public function render()
    {
        return view('livewire.frontend.footer');
    }
}
