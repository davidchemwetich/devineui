<?php

namespace App\Livewire\Frontend\Develop;

use App\Models\Project;
use App\Models\ProjectType;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsComponent extends Component
{
    use WithPagination;

    public $activeTab = 'all';
    public $search = '';
    public $showDetails = null;
    public $selectedProject = null;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Initialize with first project expanded on mobile
        $firstProject = Project::with('type')->first();
        if ($firstProject && empty($this->showDetails)) {
            $this->showDetails = $firstProject->id;
        }
    }

    public function getProjectsProperty()
    {
        $query = Project::with('type');

        // Filter by project type if not 'all'
        if ($this->activeTab !== 'all') {
            $query->whereHas('type', function ($q) {
                $q->where('name', $this->activeTab);
            });
        }

        // Search functionality
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return $query->latest()->paginate(10);
    }

    public function getFeaturedProjectsProperty()
    {
        return Project::with('type')
            ->where('featured', true)
            ->orWhere('progress_percentage', '>', 50) // Auto-feature projects with good progress
            ->latest()
            ->limit(6)
            ->get();
    }

    public function getProjectTypesProperty()
    {
        return ProjectType::withCount('projects')
            ->having('projects_count', '>', 0)
            ->get();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function toggleDetails($projectId)
    {
        if ($this->showDetails === $projectId) {
            $this->showDetails = null;
        } else {
            $this->showDetails = $projectId;
            $this->selectedProject = Project::with('type')->find($projectId);
        }
    }

    public function render()
    {
        return view('livewire.frontend.develop.projects-component', [
            'projects' => $this->projects,
            'featuredProjects' => $this->featuredProjects,
            'projectTypes' => $this->projectTypes,
        ])->layout('web.layouts.front-layout');
    }
}