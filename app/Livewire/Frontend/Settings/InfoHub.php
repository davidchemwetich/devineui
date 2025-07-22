<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;

class InfoHub extends Component
{
    public $activeTab = 'articles';

    public function render()
    {
        return view('livewire.frontend.settings.info-hub')
            ->layout('web.layouts.front-layout');
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
}
