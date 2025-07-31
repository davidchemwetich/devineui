<?php
/*
=================================================================================================
OPTIMIZED LIVEWIRE COMPONENT (HeroSlideManager.php)
=================================================================================================
Key Improvements:
- The original PHP code was already well-structured and efficient.
- No significant changes were needed here as the UI/UX enhancements (dark mode, loading states)
  are primarily handled in the Blade/Tailwind/Alpine layer.
- The logic for validation, file handling, database interaction, and state management remains
  robust and effective for this component.
*/

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

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterStatus' => ['except' => '']
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $slides = HeroSlide::query()
            ->when($this->search, fn($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
            ->when($this->filterType, fn($query, $type) => $query->where('media_type', $type))
            ->when($this->filterStatus !== '', fn($query) => $query->where('is_active', (bool)$this->filterStatus))
            ->orderBy('created_at', 'desc')
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
        $this->isEditing = false;
        $this->showForm = true;
    }

    public function editSlide($slideId)
    {
        $slide = HeroSlide::findOrFail($slideId);
        $this->slideId = $slide->id;
        $this->media_type = $slide->media_type;
        $this->current_media_path = $slide->media_path;
        $this->title = $slide->title;
        $this->is_active = $slide->is_active;

        $this->isEditing = true;
        $this->showForm = true;
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

    protected function validateStep1()
    {
        $this->validate(['media_type' => 'required|in:image,video']);
    }

    protected function validateStep2()
    {
        $rules = [];
        if (!$this->isEditing || $this->media_file) {
            $rules['media_file'] = ($this->media_type === 'image')
                ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240' // 10MB
                : 'required|mimetypes:video/mp4,video/webm,video/ogg|max:51200'; // 50MB
        }
        if (!empty($rules)) {
            $this->validate($rules);
        }
    }

    public function save()
    {
        $this->validateStep1();
        $this->validateStep2();
        $this->validate([
            'title' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        try {
            $data = [
                'media_type' => $this->media_type,
                'title' => $this->title,
                'is_active' => $this->is_active,
            ];

            if ($this->media_file) {
                if ($this->isEditing && $this->current_media_path) {
                    Storage::disk('public')->delete($this->current_media_path);
                }
                $data['media_path'] = $this->media_file->store('hero-slides', 'public');
            }

            if ($this->isEditing) {
                $slide = HeroSlide::findOrFail($this->slideId);
                $slide->update($data);
                $message = 'Hero slide updated successfully!';
            } else {
                HeroSlide::create($data);
                $message = 'Hero slide created successfully!';
            }

            $this->dispatch('notify', ['type' => 'success', 'message' => $message]);
            $this->closeForm();
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'An error occurred while saving the slide.'
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
            if ($slide->media_path) {
                Storage::disk('public')->delete($slide->media_path);
            }
            $slide->delete();
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Hero slide deleted successfully!']);
        } catch (\Exception $e) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Failed to delete hero slide.']);
        } finally {
            $this->closeDeleteModal();
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
        $this->dispatch('notify', ['type' => 'success', 'message' => "Hero slide {$status} successfully!"]);
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->slideId = null;
        $this->media_type = 'image';
        $this->media_file = null;
        $this->current_media_path = null;
        $this->title = '';
        $this->is_active = true;
        $this->currentStep = 1;
    }

    // Listen for updates to query string properties and reset pagination
    public function updated($property)
    {
        if (in_array($property, ['search', 'filterType', 'filterStatus'])) {
            $this->resetPage();
        }
    }
}