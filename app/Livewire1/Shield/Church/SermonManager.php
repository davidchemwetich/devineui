<?php

namespace App\Livewire\Shield\Church;

use App\Models\Sermon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SermonManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $category = '';
    public $confirmingSermonDeletion = false;
    public $confirmingFeatureToggle = false;
    public $sermonIdBeingDeleted;
    public $sermonIdBeingFeatured;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'category' => ['except' => ''],
    ];

    public function render()
    {
        $sermons = Sermon::query()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                return $query->where('category', $this->category);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.shield.church.sermon-manager', [
            'sermons' => $sermons,
            'categories' => ['Faith', 'Family', 'End Times', 'Other'],
        ])->layout('shield.layouts.shield-layout');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function confirmSermonDeletion($sermonId)
    {
        $this->confirmingSermonDeletion = true;
        $this->sermonIdBeingDeleted = $sermonId;
    }

    public function deleteSermon()
    {
        $sermon = Sermon::findOrFail($this->sermonIdBeingDeleted);
        
        // Delete associated files
        if ($sermon->audio_path) {
            Storage::delete($sermon->audio_path);
        }
        if ($sermon->pdf_path) {
            Storage::delete($sermon->pdf_path);
        }
        if ($sermon->cover_image) {
            Storage:: delete($sermon->cover_image);
        }

        $sermon->delete();
        $this->confirmingSermonDeletion = false;
        $this->sermonIdBeingDeleted = null;
        session()->flash('message', 'Sermon deleted successfully.');
    }

    public function confirmFeatureToggle($sermonId)
    {
        $this->confirmingFeatureToggle = true;
        $this->sermonIdBeingFeatured = $sermonId;
    }

    public function toggleFeatured()
    {
        $sermon = Sermon::findOrFail($this->sermonIdBeingFeatured);
        $sermon->is_featured = !$sermon->is_featured;
        $sermon->save();
        $this->confirmingFeatureToggle = false;
        $this->sermonIdBeingFeatured = null;
        session()->flash('message', 'Sermon feature status updated successfully.');
    }
}