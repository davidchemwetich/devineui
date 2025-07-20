<?php

namespace App\Livewire\Shield\Category;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $categoryId;
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
        'slug' => 'required|string|max:255|unique:categories,slug',
    ];

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $this->categoryId = $categoryId;
            $this->loadCategory();
        }
    }

    public function loadCategory()
    {
        $category = Category::findOrFail($this->categoryId);
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
            ]
        );

        $this->reset();
        session()->flash('message', 'Category saved successfully.');
        return redirect()->route(config('app.admin_prefix') . '.categories.index');
    }

    public function render()
    {
        return view('livewire.shield.category.category-form')->layout('shield.layouts.shield-layout');
    }
}
