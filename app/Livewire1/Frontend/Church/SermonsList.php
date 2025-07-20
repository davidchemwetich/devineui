<?php

namespace App\Livewire\Frontend\Church;

use App\Models\Sermon;
use Livewire\Component;
use Livewire\WithPagination;

class SermonsList extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sortField = 'preached_on';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sortField' => ['except' => 'preached_on'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
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

    public function render()
    {
        $sermons = Sermon::query()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                return $query->where('category', $this->category);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(9);

        $categories = Sermon::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return view('livewire.frontend.church.sermons-list', [
            'sermons' => $sermons,
            'categories' => $categories,
        ])->layout('front.layouts.front-layout');
    }
}