<?php

namespace App\Livewire\Shield\Cluster;

use Livewire\Component;
use App\Models\Cluster;
use App\Models\Region;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showModal = false;
    public $modalTitle = '';
    public $modalMode = 'create'; // 'create' or 'edit'

    // Form properties
    public $clusterId;
    public $region_id;
    public $cluster_name = '';
    public $searchTerm = '';
    public $filterRegion = '';

    protected $listeners = ['refreshClusters' => '$refresh'];

    protected function rules()
    {
        return [
            'region_id' => 'required|exists:regions,id',
            'cluster_name' => 'required|string|max:255',
        ];
    }

    public function render()
    {
        $query = Cluster::with('region')
            ->where('cluster_name', 'like', '%' . $this->searchTerm . '%')
            ->withCount('churches');

        if ($this->filterRegion) {
            $query->where('region_id', $this->filterRegion);
        }

        $clusters = $query->orderBy('cluster_name')->paginate(10);
        $regions = Region::orderByName()->get();

        return view('livewire.shield.cluster.index', [
            'clusters' => $clusters,
            'regions' => $regions,
        ])->layout('shield.layouts.shield-layout');
    }

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset('clusterId', 'region_id', 'cluster_name');
        $this->modalMode = 'create';
        $this->modalTitle = 'Create New Cluster';
        $this->showModal = true;
    }

    public function openEditModal($clusterId)
    {
        $this->resetValidation();
        $this->modalMode = 'edit';
        $this->clusterId = $clusterId;
        $cluster = Cluster::findOrFail($clusterId);
        $this->region_id = $cluster->region_id;
        $this->cluster_name = $cluster->cluster_name;
        $this->modalTitle = 'Edit Cluster';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->modalMode === 'create') {
            Cluster::create([
                'region_id' => $this->region_id,
                'cluster_name' => $this->cluster_name,
            ]);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Cluster created successfully!'
            ]);
        } else {
            $cluster = Cluster::findOrFail($this->clusterId);
            $cluster->update([
                'region_id' => $this->region_id,
                'cluster_name' => $this->cluster_name,
            ]);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Cluster updated successfully!'
            ]);
        }

        $this->showModal = false;
    }

    public function deleteConfirm($clusterId)
    {
        $this->dispatch('confirmDelete', [
            'id' => $clusterId,
            'name' => Cluster::find($clusterId)->cluster_name,
            'action' => 'deleteCluster',
        ]);
    }

    public function deleteCluster($clusterId)
    {
        $cluster = Cluster::findOrFail($clusterId);
        $cluster->delete();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Cluster deleted successfully!'
        ]);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'searchTerm') {
            $this->resetPage();
        }
    }
}