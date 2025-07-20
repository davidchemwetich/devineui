<?php

namespace App\Livewire\Shield\Ministry;

use App\Models\Ministry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class MinistryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $leaderFilter = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $confirmingDeletion = false;
    public $ministryToDelete = null;
    public $leaders = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'leaderFilter' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    protected $listeners = ['refreshMinistries' => '$refresh'];

    public function mount()
    {
        $this->leaders = User::whereIn('id', Ministry::pluck('leader_id')->unique()->filter())->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLeaderFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletion = true;
        $this->ministryToDelete = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->ministryToDelete = null;
    }

    public function deleteMinistry()
    {
        if ($this->ministryToDelete) {
            try {
                $ministry = Ministry::findOrFail($this->ministryToDelete);
                
                // Delete primary image
                if ($ministry->primary_image) {
                    Storage::delete('public/' . $ministry->primary_image);
                }
                
                // Delete gallery images
                if ($ministry->gallery_images) {
                    foreach ($ministry->gallery_images as $image) {
                        Storage::delete('public/' . $image);
                    }
                }
                
                // Delete ministry
                $ministry->delete();
                
                session()->flash('message', 'Ministry deleted successfully!');
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to delete ministry: ' . $e->getMessage());
            }
            
            $this->confirmingDeletion = false;
            $this->ministryToDelete = null;
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->leaderFilter = '';
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function render()
    {
        $ministries = Ministry::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('description', 'like', '%' . $this->search . '%')
                          ->orWhere('activities', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->leaderFilter, function ($query) {
                $query->where('leader_id', $this->leaderFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.shield.ministry.ministry-index', [
            'ministries' => $ministries,
        ])->layout('shield.layouts.shield');
    }
}