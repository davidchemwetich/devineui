<?php

namespace App\Livewire\Shield\Develop;

use Livewire\Component;
use App\Models\Development;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DevelopmentForm extends Component
{
    use WithFileUploads;

    public Development $development;
    public $developmentId;
    public $featured_image;
    public $tags = '';
    public $users = [];
    public $isEditMode = false;

    // Form validation rules
    protected function rules()
    {
        $rules = [
            'development.title' => 'required|min:3|max:255',
            'development.description' => 'required',
            'development.type' => 'required|in:Building Project,Outreach,Community Event',
            'development.status' => 'required|in:Planned,Ongoing,Completed',
            'development.start_date' => 'nullable|date',
            'development.end_date' => 'nullable|date|after_or_equal:development.start_date',
            'development.location' => 'nullable|string|max:255',
            'featured_image' => $this->isEditMode ? 'nullable|image|max:1024' : 'required|image|max:1024',
            'development.target_amount' => 'nullable|numeric|min:0',
            'development.donation_link' => 'nullable|url',
            'development.project_lead' => 'nullable|exists:users,id',
            'development.volunteer_needed' => 'boolean',
            'development.volunteer_description' => 'nullable|string',
            'tags' => 'nullable|string',
        ];

        return $rules;
    }

    public function mount($id = null)
    {
        $this->users = User::all();

        if ($id) {
            $this->developmentId = $id;
            $this->development = Development::findOrFail($id);
            $this->isEditMode = true;

            if ($this->development->tags) {
                $this->tags = implode(', ', $this->development->tags);
            }
        } else {
            $this->development = new Development();
            $this->development->volunteer_needed = false;
            $this->development->status = 'Planned';
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Process tags
        if (!empty($this->tags)) {
            $tagArray = array_map('trim', explode(',', $this->tags));
            $this->development->tags = $tagArray;
        } else {
            $this->development->tags = [];
        }

        // Generate slug
        $this->development->slug = Str::slug($this->development->title);

        // Handle image upload
        if ($this->featured_image) {
            // Delete old image if exists
            if ($this->isEditMode && $this->development->featured_image && Storage::exists($this->development->featured_image)) {
                Storage::delete($this->development->featured_image);
            }

            $imagePath = $this->featured_image->store('public/developments');
            $this->development->featured_image = $imagePath;
        }

        $this->development->save();

        session()->flash('message', $this->isEditMode ? 'Development project updated successfully.' : 'Development project created successfully.');

        return redirect()->route(config('app.admin_prefix') . '.development.index');
    }

    public function render()
    {
        return view('livewire.shield.develop.development-form', [
            'statuses' => ['Planned', 'Ongoing', 'Completed'],
            'types' => ['Building Project', 'Outreach', 'Community Event'],
        ])->layout('shield.layouts.shield-layout');
    }
}