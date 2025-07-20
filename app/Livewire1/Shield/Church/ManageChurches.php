<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\Church;
use App\Models\Region;
use Livewire\WithPagination;

class ManageChurches extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $regionFilter = '';
    public $clusterFilter = '';
    public $deleteId = null;
    public $editId = null;
    public $showDeleteModal = false;

    protected $listeners = [
        'churchSaved' => '$refresh',
        'churchDeleted' => '$refresh',
        'closeForm' => 'hideForm',
    ];

    public function mount()
    {
        $this->editId = null;
    }

    public function render()
    {
        $churches = Church::query()
            ->when($this->searchTerm, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->when($this->regionFilter, function ($query) {
                return $query->where('region_id', $this->regionFilter);
            })
            ->when($this->clusterFilter, function ($query) {
                return $query->where('cluster_id', $this->clusterFilter);
            })
            ->orderBy('name')
            ->paginate(10);

        $regions = Region::orderByName()->get();

        return view('livewire.shield.church.manage-churches', [
            'churches' => $churches,
            'regions' => $regions,
        ])->layout('shield.layouts.shield-layout');
    }

    public function showDeleteModal($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hideDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function deleteChurch()
    {
        if ($this->deleteId) {
            Church::find($this->deleteId)->delete();
            $this->hideDeleteModal();
            $this->dispatchBrowserEvent('notify', ['message' => 'Church deleted successfully!']);
        }
    }

    public function createChurch()
    {
        $this->editId = 'new';
    }

    public function editChurch($id)
    {
        $this->editId = $id;
    }

    public function hideForm()
    {
        $this->editId = null;
    }

    public function resetFilters()
    {
        $this->reset(['searchTerm', 'regionFilter', 'clusterFilter']);
    }
}