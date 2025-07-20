<?php

namespace App\Livewire\Shield\Church;

use App\Models\Sermon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SermonForm extends Component
{
    use WithFileUploads;

    // Component Properties
    public $sermonId;
    public $title;
    public $description;
    public $preached_on;
    public $audio; // For file upload
    public $video_url; // Make sure this matches exactly
    public $pdf; // For file upload
    public $cover_image; // For file upload
    public $is_featured = false;
    public $category;
    
    // Store existing paths
    public $existing_audio_path;
    public $existing_pdf_path;
    public $existing_cover_image;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'preached_on' => 'nullable|date',
        'audio' => 'nullable|file|mimes:mp3,wav,m4a|max:20000',
        'video_url' => 'nullable|url',
        'pdf' => 'nullable|file|mimes:pdf|max:10000',
        'cover_image' => 'nullable|image|max:2048',
        'is_featured' => 'boolean',
        'category' => 'nullable|in:Faith,Family,End Times,Other',
    ];

    public function mount($sermonId = null)
    {
        if ($sermonId) {
            $sermon = Sermon::findOrFail($sermonId);
            $this->sermonId = $sermonId;
            $this->title = $sermon->title;
            $this->description = $sermon->description;
            $this->preached_on = $sermon->preached_on;
            $this->video_url = $sermon->video_url; // Ensure this is being set
            $this->is_featured = $sermon->is_featured;
            $this->category = $sermon->category;
            
            // Store existing paths
            $this->existing_audio_path = $sermon->audio_path;
            $this->existing_pdf_path = $sermon->pdf_path;
            $this->existing_cover_image = $sermon->cover_image;
        }
    }

    public function submit()
    {
        $this->validate();
        
        try {
            // Debug: Log values before saving
            \Illuminate\Support\Facades\Log::info("Submitting sermon with video_url: {$this->video_url}");
            
            // Prepare data array with all fields
            $data = [
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'preached_on' => $this->preached_on,
                'video_url' => $this->video_url, // This should work now
                'is_featured' => $this->is_featured,
                'category' => $this->category,
            ];
            
            // Handle file uploads for audio
            if ($this->audio) {
                $data['audio_path'] = $this->audio->store('sermons/audio', 'public');
            } elseif ($this->sermonId) {
                // Keep existing path if in edit mode
                $data['audio_path'] = $this->existing_audio_path;
            }
            
            // Handle file uploads for PDF
            if ($this->pdf) {
                $data['pdf_path'] = $this->pdf->store('sermons/pdf', 'public');
            } elseif ($this->sermonId) {
                // Keep existing path if in edit mode
                $data['pdf_path'] = $this ->existing_pdf_path;
            }
            
            // Handle file uploads for cover image
            if ($this->cover_image) {
                $data['cover_image'] = $this->cover_image->store('sermons/images', 'public');
            } elseif ($this->sermonId) {
                // Keep existing path if in edit mode
                $data['cover_image'] = $this->existing_cover_image;
            }

            // Save the sermon to the database
            Sermon::updateOrCreate(['id' => $this->sermonId], $data);

            // Optionally, reset the form fields after submission
            $this->reset();
            session()->flash('message', 'Sermon saved successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Error saving sermon: ' . $e->getMessage());
            session()->flash('error', 'There was an error saving the sermon.');
        }
    }

    public function render()
    {
        return view('livewire.shield.church.sermon-form')->layout('shield.layouts.shield');
    }
}