<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use App\Models\AboutUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AboutUsManager extends Component
{
    use WithFileUploads;

    public array $state = [];
    public ?AboutUs $aboutUs = null;
    public $newImage;
    public $previewMode = false;

    public function mount()
    {
        $this->aboutUs = AboutUs::firstOrNew([]);
        $this->state = $this->aboutUs->attributesToArray();
        // Ensure all keys are present even if the model is new
        $this->state = array_merge([
            'heading' => '',
            'subheading' => '',
            'content' => '',
            'mission_statement' => '',
            'vision_statement' => '',
            'youtube_url' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'image_path' => null,
        ], $this->state);
    }

    protected function rules()
    {
        return [
            'state.heading' => 'required|string|max:255',
            'state.subheading' => 'nullable|string|max:255',
            'state.content' => 'required|string|min:20',
            'state.mission_statement' => 'required|string|min:20',
            'state.vision_statement' => 'required|string|min:20',
            // FIX: Using the Regex rule object for robust validation
            'state.youtube_url' => [
                'nullable',
                'url',
                'regex:~^(https?://)?(www\.)?(youtube\.com|youtu\.?be)/.+$~'
            ],
            'state.meta_keywords' => 'nullable|string|max:255',
            'newImage' => 'nullable|image|max:2048', // 2MB Max
        ];
    }

    protected $messages = [
        'state.youtube_url.regex' => 'The YouTube URL format is invalid.',
        'state.meta_description.max' => 'The meta description should not exceed 160 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        if ($this->newImage) {
            if ($this->state['image_path']) {
                Storage::disk('public')->delete($this->state['image_path']);
            }
            $this->state['image_path'] = $this->newImage->store('about-us', 'public');
        }

        $this->state['last_updated_by'] = Auth::id();

        $this->aboutUs->fill($this->state);
        $this->aboutUs->save();

        $this->newImage = null;

        $this->dispatch('notify', ['message' => 'About Us page updated successfully!', 'type' => 'success']);
    }

    public function togglePreview()
    {
        $this->previewMode = !$this->previewMode;
    }
    
    public function removeImage()
    {
        if ($this->state['image_path']) {
            Storage::disk('public')->delete($this->state['image_path']);
            $this->state['image_path'] = null;
            $this->aboutUs->image_path = null;
            $this->aboutUs->save();
            $this->dispatch('notify', ['message' => 'Image removed successfully.', 'type' => 'success']);
        }
    }

    public function render()
    {
        return view('livewire.shield.settings.about-us-manager')
            ->layout('shield.layouts.shield');
    }
}

 
