<?php

namespace App\Livewire\Frontend\Settings;

use Livewire\Component;
use App\Models\Church;
use App\Models\Region;
use App\Models\Cluster;
use Livewire\WithPagination;



class FrontChurch extends Component
{
    use WithPagination;

    public $selectedRegion = null;
    public $selectedCluster = null;
    public $selectedChurch = null;
    public $showDetail = false;

    public function updatedSelectedRegion()
    {
        $this->selectedCluster = null;
        $this->resetPage();
    }

    public function updatedSelectedCluster()
    {
        $this->resetPage();
    }

    public function viewChurchDetail($churchId)
    {
        $this->selectedChurch = Church::with(['region', 'cluster', 'churchLeaders'])->find($churchId);
        $this->showDetail = true;
    }

    public function backToList()
    {
        $this->selectedChurch = null;
        $this->showDetail = false;
    }

    public function render()
    {
        // Only fetch data if we're not showing a detail view
        if (!$this->showDetail) {
            $query = Church::query()
                ->when($this->selectedRegion, function ($query) {
                    return $query->where('region_id', $this->selectedRegion);
                })
                ->when($this->selectedCluster, function ($query) {
                    return $query->where('cluster_id', $this->selectedCluster);
                })
                ->orderBy('name');

            $churches = $query->paginate(9);
            $regions = Region::all();
            $clusters = Cluster::when($this->selectedRegion, function ($query) {
                return $query->where('region_id', $this->selectedRegion);
            })->get();
        } else {
            $churches = null;
            $regions = null;
            $clusters = null;
        }

        return view('livewire.frontend.settings.front-church', [
            'churches' => $churches,
            'regions' => $regions,
            'clusters' => $clusters,
        ])->layout('front.layouts.front-layout');
    }
}
