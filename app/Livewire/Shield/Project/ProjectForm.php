<?php

namespace App\Livewire\Shield\Project;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectForm extends Component
{
    use WithFileUploads;

    public $projectId;
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Basic Information
    public $project_type_id;
    public $title;
    public $description;

    // Step 2: Financial Goals
    public $goal_amount;
    public $raised_amount = 0;

    // Step 3: Media & Updates
    public $featured_image;
    public $existing_image;
    public $latest_update;
    public $latest_update_date;

    // Step 4: Review & Submit
    public $project_types = [];

    protected function rules()
    {
        $rules = [
            'project_type_id' => 'required|exists:project_types,id',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'goal_amount' => 'required|numeric|min:1',
            'raised_amount' => 'nullable|numeric|min:0',
            'latest_update' => 'nullable|string',
            'latest_update_date' => 'nullable|date',
        ];

        if ($this->featured_image && !is_string($this->featured_image)) {
            $rules['featured_image'] = 'image|max:2048'; // 2MB max
        }

        return $rules;
    }

    protected $messages = [
        'project_type_id.required' => 'Please select a project type.',
        'title.required' => 'Project title is required.',
        'title.min' => 'Project title must be at least 3 characters.',
        'description.required' => 'Project description is required.',
        'description.min' => 'Description must be at least 10 characters.',
        'goal_amount.required' => 'Goal amount is required.',
        'goal_amount.min' => 'Goal amount must be greater than 0.',
        'featured_image.image' => 'Featured image must be a valid image file.',
        'featured_image.max' => 'Featured image must not exceed 2MB.',
    ];

    public function mount($projectId = null)
    {
        $this->projectId = $projectId;
        $this->project_types = ProjectType::orderBy('name')->get();

        if ($this->projectId) {
            $this->loadProject();
        }

        if (!$this->latest_update_date) {
            $this->latest_update_date = now()->format('Y-m-d');
        }
    }

    public function loadProject()
    {
        $project = Project::findOrFail($this->projectId);
        
        $this->project_type_id = $project->project_type_id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->goal_amount = $project->goal_amount;
        $this->raised_amount = $project->raised_amount;
        $this->existing_image = $project->featured_image;
        $this->latest_update = $project->latest_update;
        $this->latest_update_date = $project->latest_update_date?->format('Y-m-d');
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
        match($this->currentStep) {
            1 => $this->validate([
                'project_type_id' => 'required|exists:project_types,id',
                'title' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:10',
            ]),
            2 => $this->validate([
                'goal_amount' => 'required|numeric|min:1',
                'raised_amount' => 'nullable|numeric|min:0',
            ]),
            3 => $this->validate([
                'latest_update' => 'nullable|string',
                'latest_update_date' => 'nullable|date',
                'featured_image' => $this->featured_image && !is_string($this->featured_image) ? 'image|max:2048' : '',
            ]),
            default => null,
        };
    }

    public function save()
    {
        $this->validate();

        $data = [
            'project_type_id' => $this->project_type_id,
            'title' => $this->title,
            'description' => $this->description,
            'goal_amount' => $this->goal_amount,
            'raised_amount' => $this->raised_amount ?? 0,
            'latest_update' => $this->latest_update,
            'latest_update_date' => $this->latest_update_date,
        ];

        // Handle file upload
        if ($this->featured_image && $this->featured_image instanceof TemporaryUploadedFile) {
            // Delete old image if updating
            if ($this->projectId && $this->existing_image) {
                Storage::disk('public')->delete($this->existing_image);
            }
            
            $data['featured_image'] = $this->featured_image->store('projects', 'public');
        }

        if ($this->projectId) {
            $project = Project::findOrFail($this->projectId);
            $project->update($data);
            $message = 'Project updated successfully!';
        } else {
            Project::create($data);
            $message = 'Project created successfully!';
        }

        session()->flash('message', $message);
       return redirect()->route(config('app.admin_prefix', 'shield') . '.project.index');
    }

    public function render()
    {
        return view('livewire.shield.project.project-form')
            ->layout('shield.layouts.shield');
    }
}