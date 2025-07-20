<?php

namespace App\Livewire\Shield\Article;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ArticleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $articleIdToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmArticleDeletion($articleId)
    {
        $this->articleIdToDelete = $articleId;
        $this->showDeleteModal = true;
    }

    public function deleteArticle()
    {
        Article::findOrFail($this->articleIdToDelete)->delete();
        $this->showDeleteModal = false;
        $this->articleIdToDelete = null;
        session()->flash('message', 'Article deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->articleIdToDelete = null;
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

    #[On('article-created')]
    #[On('article-updated')]
    public function refreshArticles()
    {
        // This method will be triggered when an article is created or updated
    }

    public function render()
    {
        $categories = Category::all();

        $articles = Article::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhere('scripture_reference', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter, function ($query) {
                if ($this->statusFilter === 'published') {
                    $query->where('is_published', true);
                } elseif ($this->statusFilter === 'draft') {
                    $query->where('is_published', false);
                } elseif ($this->statusFilter === 'featured') {
                    $query->where('is_featured', true);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with(['category', 'user'])
            ->paginate(10);

        return view('livewire.shield.article.article-management', [
            'articles' => $articles,
            'categories' => $categories, // Fixed typo here - removed space
        ])->layout('shield.layouts.shield');
    }
}