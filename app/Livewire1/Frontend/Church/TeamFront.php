<?php

namespace App\Livewire\Frontend\Church;

use Livewire\Component;
use App\Models\TeamMember;

class TeamFront extends Component
{
    public function render()
    {
        // Get active team members ordered by the 'order' column
        $team = TeamMember::where('status', 1)
                          ->orderBy('order')
                          ->with('category') // Eager load the category relation
                          ->get()
                          ->map(function ($member) {
                              return [
                                  'name' => $member->name,
                                  'role' => $member->role,
                                  'location' => $member->location,
                                  'profile_image' => $member->profile_image,
                                  'category' => $member->category ? $member->category->name : null,
                              ];
                          });

        return view('livewire.frontend.church.team-front', [
            'team' => $team
        ]);
    }
}