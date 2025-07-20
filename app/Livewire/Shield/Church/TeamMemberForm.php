<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\TeamMember;
use App\Models\TeamCategory;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TeamMemberForm extends Component
{
    use WithFileUploads;

    public TeamMember $teamMember;
    public $categories = [];
    public $newProfileImage;
    public $isEdit = false;

    // Form fields
    public $team_category_id;
    public $name;
    public $role;
    public $location;
    public $email;
    public $phone;
    public $whatsapp;
    public $facebook_url;
    public $order = 0;
    public $status = 'active';

    protected $rules = [
        'team_category_id' => 'required|exists:team_categories,id',
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'location' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'whatsapp' => 'nullable|string|max:255',
        'facebook_url' => 'nullable|url|max:255',
        'order' => 'integer|min:0',
        'status' => 'required|in:active,inactive',
        'newProfileImage' => 'nullable|image|max:1024', // Max 1MB
    ];

    public function mount($id = null)
    {
        $this->categories = TeamCategory::all();

        if ($id) {
            $this->teamMember = TeamMember::findOrFail($id);
            $this->isEdit = true;

            // Fill form fields
            $this->team_category_id = $this->teamMember->team_category_id;
            $this->name = $this->teamMember->name;
            $this->role = $this->teamMember->role;
            $this->location = $this->teamMember->location;
            $this->email = $this->teamMember->email;
            $this->phone = $this->teamMember->phone;
            $this->whatsapp = $this->teamMember->whatsapp;
            $this->facebook_url = $this->teamMember->facebook_url;
            $this->order = $this->teamMember->order;
            $this->status = $this->teamMember->status;
        } else {
            $this->teamMember = new TeamMember();
        }
    }

    public function save()
    {
        $this->validate();

        // Handle profile image upload
        if ($this->newProfileImage) {
            $imagePath = $this->newProfileImage->store('team-members', 'public');
            $this->teamMember->profile_image = $imagePath;
        }

        // Set model attributes
        $this->teamMember->team_category_id = $this->team_category_id;
        $this->teamMember->name = $this->name;
        $this->teamMember->role = $this->role;
        $this->teamMember->location = $this->location;
        $this->teamMember->email = $this->email;
        $this->teamMember->phone = $this->phone;
        $this->teamMember->whatsapp = $this->whatsapp;
        $this->teamMember->facebook_url = $this->facebook_url;
        $this->teamMember->order = $this->order;
        $this->teamMember->status = $this->status;
        $this->teamMember->last_updated_by = Auth::id();

        $this->teamMember->save();

        $message = $this->isEdit
            ? 'Team member updated successfully.'
            : 'Team member created successfully.';

        return redirect()->route(config('app.admin_prefix') . '.team-members.team-members')->with('message', $message);
    }

    public function render()
    {
        return view('livewire.shield.church.team-member-form')
            ->layout('shield.layouts.shield');
    }
}