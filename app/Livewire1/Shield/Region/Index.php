<?php

namespace App\Livewire\Shield\Region;

use Livewire\Component;
use App\Models\Region;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    use WithPagination;

    public $modalTitle = '';
    public $showModal = false;
    public $modalMode = 'create'; // 'create' or 'edit'

    // Form properties
    public $regionId;
    public $name = '';
    public $searchTerm = '';

    protected $listeners = ['refreshRegions' => '$refresh'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:regions,name,' . $this->regionId,
        ];
    }

    public function render()
    {
        $regions = Region::where('name', 'like', '%' . $this->searchTerm . '%')
            ->withCount(['clusters', 'churches'])
            ->orderByName()
            ->paginate(10);

        return view('livewire.shield.region.index', compact('regions'))
            ->layout('shield.layouts.shield-layout');
    }


    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset('name', 'regionId');
        $this->modalMode = 'create';
        $this->modalTitle = 'Create New Region';
        $this->showModal = true;
    }

    public function openEditModal($regionId)
    {
        $this->resetValidation();
        $this->modalMode = 'edit';
        $this->regionId = $regionId;
        $region = Region::findOrFail($regionId);
        $this->name = $region->name;
        $this->modalTitle = 'Edit Region';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->modalMode === 'create') {
            Region::create([
                'name' => $this->name,
            ]);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Region created successfully!'
            ]);
        } else {
            $region = Region::findOrFail($this->regionId);
            $region->update([
                'name' => $this->name,
            ]);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Region updated successfully!'
            ]);
        }

        $this->closeModal();


        try {
            $this->validate();

            if ($this->modalMode === 'create') {
                $region = Region::create([
                    'name' => $this->name,
                ]);

                // Debug
                dd($region);

                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Region created successfully!'
                ]);
            }
            // Rest of your code...
        } catch (\Exception $e) {
            // Log or display the error
            dd($e->getMessage());
        }
    }

    public function deleteConfirm($regionId)
    {
        $this->dispatch('confirmDelete', [
            'id' => $regionId,
            'name' => Region::find($regionId)->name,
            'action' => 'deleteRegion',
        ]);
    }

    public function deleteRegion($regionId)
    {
        $region = Region::findOrFail($regionId);
        $region->delete();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Region deleted successfully!'
        ]);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'searchTerm') {
            $this->resetPage();
        }
    }
}