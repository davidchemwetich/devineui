<?php

namespace App\Livewire\Shield\Ministry;
use App\Livewire\Shield\Ministry\MinistryEventForm;

use App\Models\Ministry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MinistryForm extends Component
{
    use WithFileUploads;

    // Form fields
    public $name = '';
    public $description = '';
    public $leader_id = null;
    public $leader_contact = '';
    public $activities = '';
    public $primaryImage = null;
    public $galleryImages = [];
    
    // Additional properties
    public $ministryId = null;
    public $isEditMode = false;
    public $users = [];
    public $errorMessage = '';
    public $debugInfo = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'leader_id' => 'nullable|exists:users,id',
        'leader_contact' => 'nullable|string|max:255',
        'activities' => 'nullable|string',
        'primaryImage' => 'nullable|image|max:2048',
        'galleryImages.*' => 'nullable|image|max:2048',
    ];

    public function mount($id = null)
    {
        $this->users = User::all();
        $this->ministryId = $id;
        
        if ($id) {
            try {
                $ministry = Ministry::findOrFail($id);
                $this->isEditMode = true;
                
                // Load existing data
                $this->name = $ministry->name;
                $this->description = $ministry->description;
                $this->leader_id = $ministry->leader_id;
                $this->leader_contact = $ministry->leader_contact;
                $this->activities = $ministry->activities;
                $this->galleryImages = $ministry->gallery_images; // Load existing gallery images
                
                $this->debugInfo['mounted_edit'] = true;
                $this->debugInfo['ministry_id'] = $id;
            } catch (\Exception $e) {
                $this->errorMessage = "Error loading ministry: " . $e->getMessage();
                Log::error('Ministry form mount error: ' . $e->getMessage(), [
                    'id' => $id,
                    'trace' => $e->getTraceAsString()
                ]);
            }
        } else {
            $this->debugInfo['mounted_create'] = true;
        }
    }

    public function save()
    {
        try {
            // Validate the input data
            $validatedData = $this->validate();
            $this->debugInfo['validation_passed'] = true;
            $this->debugInfo['validated_data'] = $validatedData;

            // Start a database transaction
            DB::beginTransaction();
            
            // Create or update the ministry
            if ($this->isEditMode) {
                $ministry = Ministry::findOrFail($this->ministryId);
            } else {
                $ministry = new Ministry();
            }
            
            // Set the basic ministry properties
            $ministry->name = $this->name;
            $ministry->description = $this->description;
            $ministry->leader_id = $this->leader_id;
            $ministry->leader_contact = $this->leader_contact;
            $ministry->activities = $this->activities;
            
            $this->debugInfo['ministry_before_save'] = [
                'name' => $ministry->name,
                'description' => $ministry->description,
                'leader_id' => $ministry->leader_id
            ];

            // Handle primary image upload
            if ($this->primaryImage) {
                $primaryImagePath = $this->primaryImage->store('ministry-images', 'public');
                $ministry->primary_image = str_replace('public/', '', $primaryImagePath);
            }

            // Handle gallery images upload
            if (!empty($this->galleryImages)) {
                $galleryImagesPaths = [];
                foreach ($this->galleryImages as $image) {
                    $path = $image->store('ministry-gallery', 'public');
                    $galleryImagesPaths[] = str_replace('public/', '', $path);
                }
                $ministry->gallery_images = $galleryImagesPaths; // This will use the updated model's mutator
            }

            // Save the ministry data to the database
            $ministry->save();
            DB::commit();

            session()->flash('message', $this->isEditMode ? 'Ministry updated successfully!' : 'Ministry created successfully!');
            return redirect()->route(config('app.admin_prefix') . '.ministry.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = "Failed to save ministry: " . $e->getMessage();
            Log::error('Ministry save error: ' . $e->getMessage(), [
                'data' => $this->debugInfo,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.shield.ministry.ministry-form', [
            'errorMessage' => $this->errorMessage,
            'debugInfo' => $this->debugInfo,
        ])->layout('shield.layouts.shield');
    }
}