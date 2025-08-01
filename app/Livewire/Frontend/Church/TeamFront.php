<?php

namespace App\Livewire\Frontend\Church;

use App\Models\TeamCategory;
use Livewire\Component;
use App\Models\TeamMember;

class TeamFront extends Component
{
    public string $categorySlug = 'church-council'; // ← Set your desired category slug here

    public function render()
    {
        $category = TeamCategory::where('slug', $this->categorySlug)->first();

        $team = collect(); // default to empty collection

        if ($category) {
            $team = $category->teamMembers()
                ->where('status', 'active')
                ->orderBy('order')
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
        }

        return view('livewire.frontend.church.team-front', [
            'team' => $team
        ]);
    }
}