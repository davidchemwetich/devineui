<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class NavigationMenu extends Component
{

    public $institutionLogo;
    public $socialLinks = [];
    public $phone;
    public $email;
    public $isSideMenuOpen = false;
    public $darkMode = false;

    public $settings;

    public function mount()
    {
        $siteSettings = SiteSetting::first();

        if ($siteSettings) {
            $this->institutionLogo = $siteSettings->institution_logo;
            $this->socialLinks = $siteSettings->social_links ?? [];
            $this->phone = $siteSettings->phone;
            $this->email = $siteSettings->email;
        }

        // Initialize dark mode from session
        $this->darkMode = session('darkMode', false);
    }


    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        session(['darkMode' => $this->darkMode]);
        $this->dispatch('dark-mode-toggled', $this->darkMode);
    }

    public function toggleSideMenu()
    {
        $this->isSideMenuOpen = !$this->isSideMenuOpen;
    }


    public function render()
    {
        return view('livewire.frontend.navigation-menu');
    }
}
