<?php

namespace App\Livewire\Shield\Ministry;

use App\Models\Ministry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class MinistryIndex extends Component
{
    use WithPagination;

    // Search and Filter
    public $search = '';
    public $leaderFilter = '';
    public $perPage = 9; // Adjusted for a 3-column grid layout

    // Sorting
    public $sortField = 'name';
    public $sortDirection = 'asc';

    // Deletion Modal
    public $confirmingDeletion = false;
    public $ministryToDelete = null;

    // Data
    public $leaders = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'leaderFilter' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 9],
    ];

    public function mount()
    {
        // Eager load leaders who are associated with at least one ministry
        $this->leaders = User::whereHas('ministries')->orderBy('name')->get();
    }

    // Reset pagination when searching or filtering
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLeaderFilter()
    {
        $this->resetPage();
    }

    /**
     * Change the sorting field and direction.
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Show the confirmation modal for deletion.
     */
    public function confirmDelete(Ministry $ministry)
    {
        $this->ministryToDelete = $ministry;
        $this->confirmingDeletion = true;
    }

    /**
     * Delete the selected ministry.
     * The Ministry model's 'deleting' event will handle file cleanup.
     */
    public function deleteMinistry()
    {
        if ($this->ministryToDelete) {
            try {
                $this->ministryToDelete->delete();
                session()->flash('message', 'Ministry deleted successfully!');
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to delete ministry: ' . $e->getMessage());
                Log::error('Ministry deletion failed: ' . $e->getMessage());
            }
        }
        $this->reset('confirmingDeletion', 'ministryToDelete');
    }

    /**
     * Reset all filters to their default state.
     */
    public function resetFilters()
    {
        $this->reset('search', 'leaderFilter');
        $this->resetPage();
    }

    public function render()
    {
        $ministries = Ministry::query()
            ->with('leader') // Eager load leader relationship
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
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
