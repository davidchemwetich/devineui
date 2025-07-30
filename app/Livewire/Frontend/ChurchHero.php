<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\HeroSlide;

class ChurchHero extends Component
{
    public function render()
    {
        $heroSlides = HeroSlide::displayReady()->get();

        return view('livewire.frontend.church-hero', [
            'heroSlides' => $heroSlides
        ]);
    }
}