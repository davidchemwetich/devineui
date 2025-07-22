<?php

namespace App\Livewire\Shield\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryCrud extends Component
{
    use WithPagination;

    /* === LISTING === */
    public string $search = '';
    protected $queryString = ['search' => ['except' => '']];

    /* === MODAL STATE === */
    public bool $showModal      = false;
    public ?int  $editingId     = null;
    public array $form          = ['name' => '', 'slug' => ''];

    /* === DELETE MODAL === */
    public bool $showDeleteModal = false;
    public ?int  $deletingId      = null;

    /* === RULES === */
    protected function rules()
    {
        return [
            'form.name' => 'required|string|max:255|unique:categories,name,'.$this->editingId,
            'form.slug' => 'required|string|max:255|unique:categories,slug,'.$this->editingId,
        ];
    }

    /* === LISTING === */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* === OPEN CREATE MODAL === */
    public function create()
    {
        $this->reset('form', 'editingId');
        $this->showModal = true;
    }

    /* === OPEN EDIT MODAL === */
    public function edit(Category $category)
    {
        $this->resetErrorBag();
        $this->editingId = $category->id;
        $this->form      = $category->only('name', 'slug');
        $this->showModal = true;
    }

    /* === SAVE === */
    public function save()
    {
        $this->validate();
        Category::updateOrCreate(
            ['id' => $this->editingId],
            $this->form
        );
        $this->closeModal();
        session()->flash('flash', [
            'type'    => 'success',
            'message' => $this->editingId ? 'Updated!' : 'Created!',
        ]);
    }

    /* === DELETE CONFIRM === */
    public function confirmDelete(Category $category)
    {
        $this->deletingId      = $category->id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Category::findOrFail($this->deletingId)->delete();
        $this->closeDeleteModal();
        session()->flash('flash', [
            'type'    => 'danger',
            'message' => 'Deleted!',
        ]);
    }

    /* === CLOSE MODALS === */
    public function closeModal()
    {
        $this->reset('showModal', 'form', 'editingId');
    }

    public function closeDeleteModal()
    {
        $this->reset('showDeleteModal', 'deletingId');
    }

    /* === RENDER === */
    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($q) => $q
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('slug', 'like', "%{$this->search}%"))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.shield.category.category-crud', compact('categories'))
               ->layout('shield.layouts.shield');
    }
}