<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use App\Models\AboutUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AboutUsManager extends Component
{
    use WithFileUploads;

    public ?AboutUs $aboutUs = null;
    public $heading = '';
    public $subheading = '';
    public $content = '';
    public $mission_statement = '';
    public $vision_statement = '';
    public $youtube_url = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $newImage = null;
    public $currentImagePath = null;
    public string $activeTab = 'basic';
    public bool $previewMode = false;

    protected $listeners = ['refreshAboutUs' => '$refresh'];

    protected function rules()
    {
        return [
            'heading' => 'required|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'content' => 'required|string',
            'mission_statement' => 'required|string',
            'vision_statement' => 'required|string',
            'youtube_url' => 'nullable|url',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'newImage' => 'nullable|image|max:2048',
        ];
    }

    public function mount()
    {
        $this->aboutUs = AboutUs::first();
        $this->initializeFields();
    }

    protected function initializeFields()
    {
        if ($this->aboutUs) {
            $this->fill($this->aboutUs->toArray());
            $this->currentImagePath = $this->aboutUs->image_path;
        } else {
        }
    }

    public function saveAboutUs()
    {
        $this->validate();

        $imagePath = $this->handleImageUpload();

        AboutUs::updateOrCreate(
            ['id' => $this->aboutUs?->id],
            $this->prepareSaveData($imagePath)
        );

        session()->flash('notification', [
            'type' => 'success',
            'message' => 'Changes saved successfully!'
        ]);

        $this->newImage = null;
    }

    protected function handleImageUpload(): string
    {
        if ($this->newImage) {
            $this->deleteOldImage();
            return $this->newImage->store('about-us', 'public');
        }

        return $this->currentImagePath ?? '';
    }

    protected function deleteOldImage()
    {
        if ($this->currentImagePath) {
            Storage::disk('public')->delete($this->currentImagePath);
        }
    }

    protected function prepareSaveData(?string $imagePath)
    {
        return [
            'heading' => $this->heading,
            'subheading' => $this->subheading,
            'content' => $this->content,
            'mission_statement' => $this->mission_statement,
            'vision_statement' => $this->vision_statement,
            'youtube_url' => $this->youtube_url,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'image_path' => $imagePath ?? $this->currentImagePath,
            'last_updated_by' => Auth::id(),
        ];
    }




    public function updatedNewImage()
    {
        $this->validateOnly('newImage');
    }

    public function render()
    {
        return view('livewire.shield.settings.about-us-manager')
            ->layout('shield.layouts.shield-layout');
    }
}