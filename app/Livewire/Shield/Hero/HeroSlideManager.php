<?php

namespace App\Livewire\Shield\Hero;

use App\Models\HeroSlide;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HeroSlideManager extends Component
{
    use WithFileUploads, WithPagination;

    // Form properties
    public $slideId = null;
    public $media_type = 'image';
    public $media_file = null;
    public $current_media_path = null;
    public $title = '';
    public $is_active = true;

    // UI state
    public $showForm = false;
    public $isEditing = false;
    public $currentStep = 1;
    public $deleteSlideId = null;
    public $showDeleteModal = false;

    // Search and filters
    public $search = '';
    public $filterType = '';
    public $filterStatus = '';

    protected $queryString = ['search', 'filterType', 'filterStatus'];

    protected $listeners = [
        'slideDeleted' => 'refreshSlides',
        'slideUpdated' => 'refreshSlides'
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $slides = HeroSlide::query()
            ->when(
                $this->search,
                fn($query) =>
                $query->where('title', 'like', '%' . $this->search . '%')
            )
            ->when(
                $this->filterType,
                fn($query) =>
                $query->where('media_type', $this->filterType)
            )
            ->when(
                $this->filterStatus !== '',
                fn($query) =>
                $query->where('is_active', (bool) $this->filterStatus)
            )
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('livewire.shield.hero.hero-slide-manager', [
            'slides' => $slides
        ])->layout('shield.layouts.shield');
    }

    // =============================================================================
    // FORM METHODS
    // =============================================================================

    public function createSlide()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
        $this->currentStep = 1;
    }

    public function editSlide($slideId)
    {
        $slide = HeroSlide::findOrFail($slideId);

        $this->slideId = $slide->id;
        $this->media_type = $slide->media_type;
        $this->current_media_path = $slide->media_path;
        $this->title = $slide->title;
        $this->is_active = $slide->is_active;

        $this->showForm = true;
        $this->isEditing = true;
        $this->currentStep = 1;
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validateStep1();
            $this->currentStep = 2;
        } elseif ($this->currentStep == 2) {
            $this->validateStep2();
            $this->currentStep = 3;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep($step)
    {
        if ($step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    protected function validateStep1()
    {
        $this->validate([
            'media_type' => 'required|in:image,video',
        ]);
    }

    protected function validateStep2()
    {
        $rules = [];

        if (!$this->isEditing || $this->media_file) {
            if ($this->media_type === 'image') {
                $rules['media_file'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240'; // 10MB
            } else {
                $rules['media_file'] = 'required|mimetypes:video/mp4,video/webm,video/ogg|max:51200'; // 50MB
            }
        }

        if (!empty($rules)) {
            $this->validate($rules);
        }
    }

    public function save()
    {
        try {
            $this->validateStep1();
            $this->validateStep2();

            $this->validate([
                'title' => 'nullable|string|max:255',
                'is_active' => 'boolean',
            ]);

            $data = [
                'media_type' => $this->media_type,
                'title' => $this->title,
                'is_active' => $this->is_active,
            ];

            // Handle file upload
            if ($this->media_file) {
                // Delete old file if editing
                if ($this->isEditing && $this->current_media_path) {
                    Storage::disk('public')->delete($this->current_media_path);
                }

                $path = $this->media_file->store('hero-slides', 'public');
                $data['media_path'] = $path;
            }

            if ($this->isEditing) {
                $slide = HeroSlide::findOrFail($this->slideId);
                $slide->update($data);
                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Hero slide updated successfully!'
                ]);
            } else {
                HeroSlide::create($data);
                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Hero slide created successfully!'
                ]);
            }

            $this->closeForm();
            $this->refreshSlides();
        } catch (ValidationException $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Please check your inputs and try again.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'An error occurred. Please try again.'
            ]);
        }
    }

    // =============================================================================
    // DELETE METHODS
    // =============================================================================

    public function confirmDelete($slideId)
    {
        $this->deleteSlideId = $slideId;
        $this->showDeleteModal = true;
    }

    public function deleteSlide()
    {
        try {
            $slide = HeroSlide::findOrFail($this->deleteSlideId);

            // Delete the media file
            if ($slide->media_path) {
                Storage::disk('public')->delete($slide->media_path);
            }

            $slide->delete();

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Hero slide deleted successfully!'
            ]);

            $this->closeDeleteModal();
            $this->refreshSlides();
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to delete hero slide.'
            ]);
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deleteSlideId = null;
    }

    // =============================================================================
    // UTILITY METHODS
    // =============================================================================

    public function toggleStatus($slideId)
    {
        $slide = HeroSlide::findOrFail($slideId);
        $slide->update(['is_active' => !$slide->is_active]);

        $status = $slide->is_active ? 'activated' : 'deactivated';
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => "Hero slide {$status} successfully!"
        ]);
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->slideId = null;
        $this->media_type = 'image';
        $this->media_file = null;
        $this->current_media_path = null;
        $this->title = '';
        $this->is_active = true;
        $this->currentStep = 1;
    }

    public function refreshSlides()
    {
        // This method refreshes the slides list
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterType = '';
        $this->filterStatus = '';
        $this->resetPage();
    }
}