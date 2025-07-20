<?php

namespace App\Livewire\Frontend\Church;

use App\Models\TeamCategory;
use Livewire\Component;

class ChurchLeadership extends Component
{
    public $categories;
    public $featuredCategory = null;
    public $activeCategory = null;

    public function mount()
    {
        // Get all categories with their team members, ordered by name
        $this->categories = TeamCategory::with(['teamMembers' => function ($query) {
            $query->where('status', 1)->orderBy('order');
        }])->orderBy('name')->get();

        // Find the featured category if any
        $this->featuredCategory = $this->categories->firstWhere('is_featured', true);

        // Set default active category (first non-featured category)
        $this->activeCategory = $this->categories->where('is_featured', false)->first()?->id ?? $this->categories->first()?->id;
    }

    public function setActiveCategory($categoryId)
    {
        $this->activeCategory = $categoryId;
    }

    public function render()
    {
        return view('livewire.frontend.church.church-leadership')
            ->layout('front.layouts.front-layout');
    }
}
