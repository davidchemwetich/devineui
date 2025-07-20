<?php

namespace App\Livewire\Frontend\Church;

use App\Models\Sermon;
use Livewire\Component;

class FeaturedSermon extends Component
{
    public $featuredSermon;

    public function mount()
    {
        $this->featuredSermon = Sermon::where('is_featured', true)
            ->latest('preached_on')
            ->first();
    }

    public function render()
    {
        return view('livewire.frontend.church.featured-sermon');
    }
}