<?php

namespace App\Livewire\Shield\Project;

use Livewire\Component;
use App\Models\ProjectType as TypeModel;
use Livewire\WithPagination;

class ProjectType extends Component
{
    use WithPagination;

    public $name;
    public $projectTypeId;

    public bool $isOpen = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:60|unique:project_types,name,' . $this->projectTypeId
        ];
    }

    public function openModal()
    {
        $this->reset(['name', 'projectTypeId']);
        $this->isOpen = true;
    }

    public function edit(TypeModel $type)
    {
        $this->projectTypeId = $type->id;
        $this->name = $type->name;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        TypeModel::updateOrCreate(
            ['id' => $this->projectTypeId],
            ['name' => $this->name]
        );

        $this->closeModal();
        session()->flash('message', 'Project type saved successfully.');
    }

    public function delete(TypeModel $type)
    {
        $type->delete();
        session()->flash('message', 'Deleted successfully.');
    }

    public function closeModal()
    {
        $this->reset(['isOpen', 'name', 'projectTypeId']);
    }

    public function render()
    {
        return view('livewire.shield.project.project-type', [
            'types' => TypeModel::withCount('projects')->orderBy('name')->paginate(10)
        ])->layout('shield.layouts.shield');
    }
}