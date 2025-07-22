<?php

namespace App\Livewire\Frontend\Chapel;

use Livewire\Component;
use App\Models\Church;
use App\Models\Cluster;
use App\Models\Region;
use Livewire\WithPagination;

class ChurchList extends Component
{
    use WithPagination;

    public $selectedRegion = '';
    public $selectedCluster = '';
    public $clusters = [];
    public $search = '';

    protected $queryString = [
        'selectedRegion' => ['except' => ''],
        'selectedCluster' => ['except' => ''],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->updatedSelectedRegion($this->selectedRegion);
    }

    public function updatedSelectedRegion($value)
    {
        $this->selectedCluster = '';
        $this->resetPage();

        if ($value) {
            $this->clusters = Cluster::where('region_id', $value)->orderByName()->get();
        } else {
            $this->clusters = [];
        }
    }

    public function updatedSelectedCluster()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $regions = Region::orderByName()->get();

        $churchesQuery = Church::query()
            ->when($this->selectedRegion, function ($query) {
                return $query->where('region_id', $this->selectedRegion);
            })
            ->when($this->selectedCluster, function ($query) {
                return $query->where('cluster_id', $this->selectedCluster);
            })
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            })
            ->orderByName();

        $churches = $churchesQuery->paginate(12);

        return view('livewire.frontend.chapel.church-list', [
            'churches' => $churches,
            'regions' => $regions,
        ])->layout('web.layouts.front-layout');
    }
}
