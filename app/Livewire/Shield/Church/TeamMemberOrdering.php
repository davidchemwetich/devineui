<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\TeamMember;
use App\Models\TeamCategory;

class TeamMemberOrdering extends Component
{
    public $selectedCategory = null;
    public $teamMembers = [];
    public $categories = [];

    public function mount()
    {
        $this->categories = TeamCategory::all();

        if ($this->categories->count() > 0) {
            $this->selectedCategory = $this->categories->first()->id;
            $this->loadTeamMembers();
        }
    }

    public function loadTeamMembers()
    {
        $this->teamMembers = TeamMember::where('team_category_id', $this->selectedCategory)
            ->where('status', 'active')
            ->orderBy('order')
            ->get()
            ->toArray();
    }

    public function changeCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadTeamMembers();
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            TeamMember::find($item['value'])->update(['order' => $item['order']]);
        }

        $this->loadTeamMembers();

        $this->dispatch('notify', [
            'message' => 'Team member order has been updated.',
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.shield.church.team-member-ordering')
            ->layout('shield.layouts.shield');
    }
}