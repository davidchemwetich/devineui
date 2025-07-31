<?php

namespace App\Livewire\Shield\Church;

use App\Models\Sermon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SermonManager extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';
    public $sortField = 'preached_on';
    public $sortDirection = 'desc';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $featuredFilter = '';

    public $sermonToDelete;
    public $confirmingSermonDeletion = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'preached_on'],
        'sortDirection' => ['except' => 'desc'],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'featuredFilter' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function confirmSermonDeletion(Sermon $sermon)
    {
        $this->sermonToDelete = $sermon;
        $this->confirmingSermonDeletion = true;
    }

    public function deleteSermon()
    {
        if (!$this->sermonToDelete) {
            return;
        }

        // Using the bootable trait to delete associated files
        $this->sermonToDelete->forceDelete();

        $this->confirmingSermonDeletion = false;
        $this->sermonToDelete = null;

        session()->flash('message', 'Sermon permanently deleted.');
    }

    public function toggleFeatured(Sermon $sermon)
    {
        $sermon->update(['is_featured' => !$sermon->is_featured]);
        session()->flash('message', 'Sermon feature status updated.');
    }

    public function toggleStatus(Sermon $sermon)
    {
        $newStatus = $sermon->status === 'published' ? 'draft' : 'published';
        $sermon->update(['status' => $newStatus]);
        session()->flash('message', 'Sermon status updated.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingFeaturedFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sermons = Sermon::query()
            ->with('user:id,name') // Eager load user to avoid N+1 problem
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, fn($query) => $query->where('category', $this->categoryFilter))
            ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
            ->when($this->featuredFilter !== '', fn($query) => $query->where('is_featured', $this->featuredFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.shield.church.sermon-manager', [
            'sermons' => $sermons,
            'categories' => Sermon::getCategories(),
            'statuses' => Sermon::getStatuses(),
        ])->layout('shield.layouts.shield');
    }
}
