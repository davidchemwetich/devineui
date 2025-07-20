<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\TeamCategory;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class TeamCategories extends Component

{
    use WithPagination;

    // Modal control
    public $isModalOpen = false;
    public $modalType = 'create'; // 'create', 'edit', 'delete'

    // Search and sorting
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    // Form data
    public $category = [
        'id' => null,
        'name' => '',
        'slug' => '',
        'is_featured' => false,
    ];

    // Listeners for events
    protected $listeners = [
        'refreshTeamCategories' => '$refresh',
    ];

    // Reset pagination when search changes
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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->modalType = 'create';
        $this->isModalOpen = true;
    }

    public function openEditModal($categoryId)
    {
        $this->resetForm();
        $this->modalType = 'edit';
        $this->loadCategory($categoryId);
        $this->isModalOpen = true;
    }

    public function openDeleteModal($categoryId)
    {
        $this->resetForm();
        $this->modalType = 'delete';
        $this->loadCategory($categoryId);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function loadCategory($categoryId)
    {
        $category = TeamCategory::findOrFail($categoryId);
        $this->category = [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'is_featured' => $category->is_featured,
        ];
    }

    public function resetForm()
    {
        $this->category = [
            'id' => null,
            'name' => '',
            'slug' => '',
            'is_featured' => false,
        ];
        $this->resetErrorBag();
    }

    public function generateSlug()
    {
        $this->category['slug'] = Str::slug($this->category['name']);
    }

    public function save()
    {
        $this->validate([
            'category.name' => 'required|string|max:255',
            'category.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('team_categories', 'slug')->ignore($this->category['id']),
            ],
            'category.is_featured' => 'boolean',
        ]);

        if (empty($this->category['id'])) {
            // Create new category
            TeamCategory::create([
                'name' => $this->category['name'],
                'slug' => $this->category['slug'],
                'is_featured' => $this->category['is_featured'],
            ]);

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Team category created successfully!'
            ]);
        } else {
            // Update existing category
            $category = TeamCategory::findOrFail($this->category['id']);
            $category->update([
                'name' => $this->category['name'],
                'slug' => $this->category['slug'],
                'is_featured' => $this->category['is_featured'],
            ]);

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Team category updated successfully!'
            ]);
        }

        $this->closeModal();
        $this->resetForm();
    }

    public function delete()
    {
        $category = TeamCategory::findOrFail($this->category['id']);

        // Count team members in this category to warn if necessary
        $memberCount = $category->teamMembers()->count();
        if ($memberCount > 0) {
            $this->dispatch('notify', [
                'type' => 'warning',
                'message' => "Category deleted. Note: {$memberCount} team members were uncategorized."
            ]);
        }

        $category->delete();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Team category deleted successfully!'
        ]);

        $this->closeModal();
        $this->resetForm();
    }

    public function toggleFeatured($categoryId)
    {
        $category = TeamCategory::findOrFail($categoryId);
        $category->is_featured = !$category->is_featured;
        $category->save();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $category->is_featured
                ? 'Category marked as featured!'
                : 'Category removed from featured!'
        ]);
    }

    public function render()
    {
        $categories = TeamCategory::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.shield.church.team-categories', [
            'categories' => $categories,
        ])->layout('shield.layouts.shield');
    }
}