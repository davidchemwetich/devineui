<?php

namespace App\Livewire\Frontend;

use App\Models\Partnership;
use Livewire\Component;

class PartnershipSlider extends Component
{
    public $animationSpeed = 30; // Default animation speed in seconds
    
    public function mount()
    {
        // You could adjust the speed based on number of partnerships or other factors
        $partnershipsCount = Partnership::where('is_active', true)->count();
        if ($partnershipsCount > 10) {
            $this->animationSpeed = 40; // Slower for more logos
        } elseif ($partnershipsCount < 5) {
            $this->animationSpeed = 20; // Faster for fewer logos
        }
    }
    
    public function render()
    {
        $partnerships = Partnership::where('is_active', true)->get();
        
        return view('livewire.frontend.partnership-slider', [
            'partnerships' => $partnerships
        ]);
    }
}
