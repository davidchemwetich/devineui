<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class NavigationMenu extends Component
{

    public $institutionLogo;
    public $phone;
    public $email;
    public $isSideMenuOpen = false;


    public $settings;

    public function mount() {}


    public function toggleSideMenu()
    {
        $this->isSideMenuOpen = !$this->isSideMenuOpen;
    }


    public function render()
    {
        return view('livewire.frontend.navigation-menu');
    }
}
