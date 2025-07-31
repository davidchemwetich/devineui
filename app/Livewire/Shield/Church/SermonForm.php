<?php

namespace App\Livewire\Shield\Church;

use App\Models\Sermon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SermonForm extends Component
{
    use WithFileUploads;

    // Component Properties
    public $sermonId;
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Basic Information
    public $title = '';
    public $description = '';
    public $preached_on = '';
    public $category = '';

    // Step 2: Media Files
    public $audio;
    public $video_url = '';
    public $pdf;

    // Step 3: Visual Content
    public $cover_image;

    // Step 4: Settings & Publishing
    public $is_featured = false;
    public $status = 'draft'; // draft, published

    // Store existing paths for editing
    public $existing_audio_path;
    public $existing_pdf_path;
    public $existing_cover_image;

    // UI State
    public $isSubmitting = false;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'preached_on' => 'nullable|date|before_or_equal:today',
            'category' => ['nullable', Rule::in(['Faith', 'Family', 'End Times', 'Worship', 'Prayer', 'Other'])],
            'audio' => 'nullable|file|mimes:mp3,wav,m4a,aac|max:50000', // 50MB

            // --- THIS IS THE CORRECTED LINE ---
            'video_url' => ['nullable', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'],

            'pdf' => 'nullable|file|mimes:pdf|max:10000', // 10MB
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB
            'is_featured' => 'boolean',
            'status' => Rule::in(['draft', 'published']),
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => 'Sermon title is required.',
            'preached_on.before_or_equal' => 'Preached date cannot be in the future.',
            'video_url.regex' => 'Please enter a valid YouTube URL.',
            'audio.max' => 'Audio file must not exceed 50MB.',
            'pdf.max' => 'PDF file must not exceed 10MB.',
            'cover_image.max' => 'Cover image must not exceed 5MB.',
        ];
    }

    public function mount($sermonId = null)
    {
        if ($sermonId) {
            $sermon = Sermon::findOrFail($sermonId);
            $this->loadSermonData($sermon);
        }

        // Set default preached date to today if creating new sermon
        if (!$sermonId && !$this->preached_on) {
            $this->preached_on = now()->format('Y-m-d');
        }
    }

    private function loadSermonData($sermon)
    {
        $this->sermonId = $sermon->id;
        $this->title = $sermon->title;
        $this->description = $sermon->description;
        $this->preached_on = $sermon->preached_on?->format('Y-m-d');
        $this->video_url = $sermon->video_url;
        $this->is_featured = $sermon->is_featured;
        $this->category = $sermon->category;
        $this->status = $sermon->status ?? 'draft';

        // Store existing file paths
        $this->existing_audio_path = $sermon->audio_path;
        $this->existing_pdf_path = $sermon->pdf_path;
        $this->existing_cover_image = $sermon->cover_image;
    }

    public function nextStep()
    {
        $this->validateCurrentStep();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
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
        if ($step <= $this->currentStep || $step == 1) {
            $this->currentStep = $step;
        }
    }

    private function validateCurrentStep()
    {
        $rules = [];

        switch ($this->currentStep) {
            case 1:
                $rules = [
                    'title' => $this->rules()['title'],
                    'description' => $this->rules()['description'],
                    'preached_on' => $this->rules()['preached_on'],
                    'category' => $this->rules()['category'],
                ];
                break;
            case 2:
                $rules = [
                    'audio' => $this->rules()['audio'],
                    'video_url' => $this->rules()['video_url'],
                    'pdf' => $this->rules()['pdf'],
                ];
                break;
            case 3:
                $rules = [
                    'cover_image' => $this->rules()['cover_image'],
                ];
                break;
        }

        if (!empty($rules)) {
            $this->validate($rules);
        }
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $this->validate();

            $data = $this->prepareSermonData();

            $sermon = Sermon::updateOrCreate(
                ['id' => $this->sermonId],
                $data
            );

            $this->handleFileUploads($sermon);

            $this->dispatchSuccessMessage();

            if (!$this->sermonId) {
                return redirect()->route('sermons.index');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->isSubmitting = false;
            throw $e;
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            \Illuminate\Support\Facades\Log::error('Error saving sermon: ' . $e->getMessage());
            session()->flash('error', 'There was an error saving the sermon. Please try again.');
        }

        $this->isSubmitting = false;
    }

    private function prepareSermonData()
    {
        return [
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'preached_on' => $this->preached_on,
            'video_url' => $this->video_url,
            'is_featured' => $this->is_featured,
            'category' => $this->category,
            'status' => $this->status,
        ];
    }

    private function handleFileUploads($sermon)
    {
        $updates = [];

        // Handle audio upload
        if ($this->audio) {
            if ($this->existing_audio_path) {
                Storage::disk('public')->delete($this->existing_audio_path);
            }
            $updates['audio_path'] = $this->audio->store('sermons/audio', 'public');
        }

        // Handle PDF upload
        if ($this->pdf) {
            if ($this->existing_pdf_path) {
                Storage::disk('public')->delete($this->existing_pdf_path);
            }
            $updates['pdf_path'] = $this->pdf->store('sermons/pdf', 'public');
        }

        // Handle cover image upload
        if ($this->cover_image) {
            if ($this->existing_cover_image) {
                Storage::disk('public')->delete($this->existing_cover_image);
            }
            $updates['cover_image'] = $this->cover_image->store('sermons/images', 'public');
        }

        if (!empty($updates)) {
            $sermon->update($updates);
        }
    }

    private function dispatchSuccessMessage()
    {
        $action = $this->sermonId ? 'updated' : 'created';
        $message = "Sermon '{$this->title}' has been {$action} successfully!";

        session()->flash('message', $message);

        // Dispatch browser event for additional UI feedback
        $this->dispatch('sermon-saved', [
            'action' => $action,
            'sermon_id' => $this->sermonId
        ]);
    }

    public function removeFile($type)
    {
        switch ($type) {
            case 'audio':
                $this->audio = null;
                break;
            case 'pdf':
                $this->pdf = null;
                break;
            case 'cover_image':
                $this->cover_image = null;
                break;
        }
    }

    public function getStepTitleProperty()
    {
        $titles = [
            1 => 'Basic Information',
            2 => 'Media Files',
            3 => 'Visual Content',
            4 => 'Settings & Publishing'
        ];

        return $titles[$this->currentStep] ?? '';
    }

    public function getProgressPercentageProperty()
    {
        return ($this->currentStep / $this->totalSteps) * 100;
    }

    public function render()
    {
        return view('livewire.shield.church.sermon-form')
            ->layout('shield.layouts.shield');
    }
}