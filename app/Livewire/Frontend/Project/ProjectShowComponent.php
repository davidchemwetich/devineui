<?php

namespace App\Livewire\Frontend\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectShowComponent extends Component
{
    public Project $project;

    public function mount($slug)
    {
        $this->project = Project::with('type')->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $relatedProjects = Project::with('type')
            ->where('project_type_id', $this->project->project_type_id)
            ->where('id', '!=', $this->project->id)
            ->limit(3)
            ->get();

        return view('livewire.frontend.project.project-show-component', [
            'relatedProjects' => $relatedProjects,
        ])->layout('web.layouts.front-layout');
    }
}