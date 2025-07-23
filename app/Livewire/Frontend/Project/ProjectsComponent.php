<?php

namespace App\Livewire\Frontend\Project;

use App\Models\Project;
use App\Models\ProjectType;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedType = '';
    public $sortBy = 'latest';

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

    public function updatingPage()
    {
        $this->dispatch('scroll-to-top');
    }

    public function render()
    {
        $query = Project::with('type');

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply type filter
        if (!empty($this->selectedType)) {
            $query->where('project_type_id', $this->selectedType);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'progress':
                $query->orderByRaw('(raised_amount / goal_amount) DESC');
                break;
            case 'goal_high':
                $query->orderBy('goal_amount', 'desc');
                break;
            case 'goal_low':
                $query->orderBy('goal_amount', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $projects = $query->paginate(12);
        $projectTypes = ProjectType::all();
        $featuredProjects = Project::with('type')
            ->orderByRaw('(raised_amount / goal_amount) DESC')
            ->limit(3)
            ->get();

        return view('livewire.frontend.project.projects-component', [
            'projects' => $projects,
            'projectTypes' => $projectTypes,
            'featuredProjects' => $featuredProjects,
        ])->layout('web.layouts.front-layout');
    }
}