<?php

namespace App\Livewire\Shield\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryIdToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function confirmCategoryDeletion($categoryId)
    {
        $this->categoryIdToDelete = $categoryId;
        $this->showDeleteModal = true;
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->categoryIdToDelete)->delete();
        $this->showDeleteModal = false;
        $this->categoryIdToDelete = null;
        session()->flash('message', 'Category deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->categoryIdToDelete = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.shield.category.category-management', [
            'categories' => $categories,
        ])->layout('shield.layouts.shield');
    }
}
