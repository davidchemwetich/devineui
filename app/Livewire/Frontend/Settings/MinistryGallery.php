<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;
use App\Models\Ministry;

class MinistryGallery extends Component
{
    public $ministries;
    public $activeMinistryId = null;
    public $selectedImage = null;

    public function mount()
    {
        // Load all ministries that have gallery images
        $this->ministries = Ministry::with('leader')
            ->whereNotNull('gallery_images')
            ->get();

        // Set default active ministry
        if ($this->ministries->isNotEmpty()) {
            $this->activeMinistryId = $this->ministries->first()->id;
        }
    }

    public function selectMinistry($id)
    {
        $this->activeMinistryId = $id;
        $this->selectedImage = null; // Reset selected image when changing ministry
    }

    public function getActiveMinistryProperty()
    {
        return $this->ministries->firstWhere('id', $this->activeMinistryId);
    }

    public function render()
    {
        return view('livewire.frontend.settings.ministry-gallery')
            ->layout('web.layouts.front-layout');
    }
}
