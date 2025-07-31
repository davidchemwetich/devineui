<?php

namespace App\Livewire\Shield\Ministry;

use App\Models\Ministry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MinistryForm extends Component
{
    use WithFileUploads;

    // Stepper State
    public $currentStep = 1;
    public $totalSteps = 4;

    // Model Properties
    public ?Ministry $ministry;
    public $ministryId = null;
    public $isEditMode = false;

    // Form Fields
    public $name = '';
    public $description = '';
    public $leader_id = null;
    public $leader_contact = '';
    public $activities = '';
    public $primaryImage = null;
    public $existingPrimaryImage = null;
    public $galleryImages = [];
    public $existingGalleryImages = [];

    // UI State
    public $users = [];
    public $errorMessage = '';

    public function mount($id = null)
    {
        // Fetch all users for the leader dropdown
        $this->users = User::orderBy('name')->get();

        // Check if we are in edit mode
        if ($id) {
            $this->isEditMode = true;
            $this->ministryId = $id;
            try {
                $this->ministry = Ministry::findOrFail($id);

                // Populate form fields from the model
                $this->name = $this->ministry->name;
                $this->description = $this->ministry->description;
                $this->leader_id = $this->ministry->leader_id;
                $this->leader_contact = $this->ministry->leader_contact;
                $this->activities = $this->ministry->activities;
                $this->existingPrimaryImage = $this->ministry->primary_image;
                $this->existingGalleryImages = $this->ministry->gallery_images ?? [];
            } catch (\Exception $e) {
                session()->flash('error', 'Error loading ministry data. ' . $e->getMessage());
                Log::error('Ministry form mount error: ' . $e->getMessage());
                return redirect()->route(config('app.admin_prefix') . '.ministry.index');
            }
        } else {
            // Initialize a new ministry instance for creation
            $this->ministry = new Ministry();
        }
    }

    /**
     * Define validation rules for each step.
     */
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'leader_id' => 'nullable|exists:users,id',
            'leader_contact' => 'nullable|string|max:255',
            'activities' => 'nullable|string|max:5000',
            'primaryImage' => 'nullable|image|max:2048', // 2MB Max
            'galleryImages.*' => 'nullable|image|max:2048', // 2MB Max for each
        ];
    }

    /**
     * Validate specific fields for the current step before proceeding.
     */
    public function validateStep($step)
    {
        $rules = [
            1 => ['name' => $this->rules()['name'], 'description' => $this->rules()['description']],
            2 => ['leader_id' => $this->rules()['leader_id'], 'leader_contact' => $this->rules()['leader_contact']],
            3 => ['activities' => $this->rules()['activities']],
            4 => ['primaryImage' => $this->rules()['primaryImage'], 'galleryImages.*' => $this->rules()['galleryImages.*']],
        ];

        if (isset($rules[$step])) {
            $this->validate($rules[$step]);
        }
    }

    /**
     * Move to the next step in the form.
     */
    public function nextStep()
    {
        $this->validateStep($this->currentStep);

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    /**
     * Move to the previous step in the form.
     */
    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    /**
     * Jump to a specific step, validating all previous steps.
     */
    public function goToStep($step)
    {
        if ($step > $this->currentStep) {
            for ($i = 1; $i < $step; $i++) {
                $this->validateStep($i);
            }
        }
        $this->currentStep = $step;
    }

    /**
     * Remove a newly uploaded gallery image from the temporary collection.
     */
    public function removeNewGalleryImage($index)
    {
        if (isset($this->galleryImages[$index])) {
            array_splice($this->galleryImages, $index, 1);
        }
    }

    /**
     * Remove an existing gallery image from the database and storage.
     */
    public function removeExistingGalleryImage($index)
    {
        if (isset($this->existingGalleryImages[$index])) {
            $imagePath = $this->existingGalleryImages[$index];

            // Remove from storage
            Storage::disk('public')->delete($imagePath);

            // Remove from array
            array_splice($this->existingGalleryImages, $index, 1);

            // Update the model in the database
            $this->ministry->gallery_images = $this->existingGalleryImages;
            $this->ministry->save();

            session()->flash('message', 'Gallery image removed successfully.');
        }
    }

    /**
     * Save the form data to the database.
     */
    public function save()
    {
        // Validate the final step's fields before saving
        $this->validateStep($this->currentStep);

        // Then, validate all fields together
        $validatedData = $this->validate();

        DB::beginTransaction();
        try {
            $this->ministry->fill([
                'name' => $this->name,
                'description' => $this->description,
                'leader_id' => $this->leader_id,
                'leader_contact' => $this->leader_contact,
                'activities' => $this->activities,
            ]);

            // Handle primary image upload
            if ($this->primaryImage) {
                // Delete old image if it exists
                if ($this->ministry->primary_image) {
                    Storage::disk('public')->delete($this->ministry->primary_image);
                }
                $this->ministry->primary_image = $this->primaryImage->store('ministry-images', 'public');
            }

            // Handle gallery images upload
            $newGalleryPaths = [];
            if (!empty($this->galleryImages)) {
                foreach ($this->galleryImages as $image) {
                    $newGalleryPaths[] = $image->store('ministry-gallery', 'public');
                }
            }
            // Merge existing and new gallery images
            $this->ministry->gallery_images = array_merge($this->existingGalleryImages, $newGalleryPaths);

            $this->ministry->save();

            DB::commit();

            session()->flash('message', $this->isEditMode ? 'Ministry updated successfully!' : 'Ministry created successfully!');
            return redirect()->route(config('app.admin_prefix') . '.ministry.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = "Failed to save ministry: " . $e->getMessage();
            Log::error('Ministry save error: ' . $e->getMessage(), ['data' => $this->all()]);
            session()->flash('error', $this->errorMessage);
        }
    }

    public function render()
    {
        return view('livewire.shield.ministry.ministry-form')
            ->layout('shield.layouts.shield');
    }
}