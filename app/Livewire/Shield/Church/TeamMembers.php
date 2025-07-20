<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\TeamMember;
use App\Models\TeamCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamMembers extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';

    public $sortField = 'order';
    public $sortDirection = 'asc';

    public $showDeleteModal = false;
    public $deleteId = null;

    public $categories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function mount()
    {
        $this->categories = TeamCategory::all();
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
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteTeamMember()
    {
        if ($this->deleteId) {
            $teamMember = TeamMember::find($this->deleteId);
            if ($teamMember) {
                $teamMember->delete();
                session()->flash('message', 'Team member has been deleted successfully.');
            }
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function toggleStatus($id)
    {
        $teamMember = TeamMember::find($id);
        if ($teamMember) {
            $teamMember->status = $teamMember->status === 'active' ? 'inactive' : 'active';
            $teamMember->last_updated_by = Auth::id();
            $teamMember->save();

            session()->flash('message', 'Status updated successfully.');
        }
    }

    public function render()
    {
        $query = TeamMember::query()
            ->with('category')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('role', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                return $query->where('team_category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection);

        $teamMembers = $query->paginate(10);

        return view('livewire.shield.church.team-members', [
            'teamMembers' => $teamMembers
        ])->layout('shield.layouts.shield');
    }
}
