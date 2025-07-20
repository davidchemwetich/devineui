<?php

namespace App\Livewire\Shield\Develop;

use Livewire\Component;
use App\Models\Development;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class DevelopmentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $typeFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
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

    public function deleteDevelopment($id)
    {
        $development = Development::findOrFail($id);

        // Delete the featured image if it exists
        if ($development->featured_image && Storage::exists($development->featured_image)) {
            Storage::delete($development->featured_image);
        }

        $development->delete();

        session()->flash('message', 'Development project deleted successfully.');
    }

    public function togglePublishStatus($id)
    {
        $development = Development::findOrFail($id);

        if ($development->published_at) {
            $development->published_at = null;
            $message = 'Project unpublished successfully.';
        } else {
            $development->published_at = now();
            $message = 'Project published successfully.';
        }

        $development->save();
        session()->flash('message', $message);
    }

    public function render()
    {
        $developments = Development::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.shield.develop.development-index', [
            'developments' => $developments,
            'statuses' => ['Planned', 'Ongoing', 'Completed'],
            'types' => ['Building Project', 'Outreach', 'Community Event'],
        ])->layout('shield.layouts.shield-layout');
    }
}