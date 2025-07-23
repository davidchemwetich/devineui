<?php

namespace App\Livewire\Shield\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Storage;

class ProjectIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedType = '';
    public $sortBy = 'latest';
    public $showDeleteModal = false;
    public $projectToDelete = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedType' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedType()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function confirmDelete($projectId)
    {
        $this->projectToDelete = Project::findOrFail($projectId);
        $this->showDeleteModal = true;
    }

    public function deleteProject()
    {
        if ($this->projectToDelete) {
            // Delete featured image if exists
            if ($this->projectToDelete->featured_image) {
                Storage::disk('public')->delete($this->projectToDelete->featured_image);
            }
            
            $this->projectToDelete->delete();
            $this->showDeleteModal = false;
            $this->projectToDelete = null;
            
            session()->flash('message', 'Project deleted successfully.');
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->projectToDelete = null;
    }

    public function getProjectsProperty()
    {
        $query = Project::with('type');

        // Apply search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply type filter
        if ($this->selectedType) {
            $query->where('project_type_id', $this->selectedType);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'title':
                $query->orderBy('title');
                break;
            case 'goal_amount':
                $query->orderBy('goal_amount', 'desc');
                break;
            case 'progress':
                $query->orderByRaw('(raised_amount / goal_amount) DESC');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.shield.project.project-index', [
            'projects' => $this->projects,
            'projectTypes' => ProjectType::orderBy('name')->get(),
        ])->layout('shield.layouts.shield');
    }
}