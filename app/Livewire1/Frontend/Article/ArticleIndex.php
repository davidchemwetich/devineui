<?php

namespace App\Livewire\Frontend\Article;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ArticleIndex extends Component
{
    use WithPagination;

    #[Url]
    public $selectedCategory = null;

    #[Url]
    public $search = '';

    #[Url]
    public $view = 'grid'; // grid or list view toggle

    public $categories;
    public $featuredArticle;
    public $recentArticles;
    public $isLoading = true;

    public function mount()
    {
        $this->categories = Category::all();
        $this->featuredArticle = Article::where('is_featured', true)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->first();

        // Get 3 recent articles for sidebar
        $this->recentArticles = Article::where('is_published', true)
            ->where('id', '!=', $this->featuredArticle?->id ?? 0)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $this->isLoading = false;
    }

    public function setView($viewType)
    {
        $this->view = $viewType;
    }

    public function clearFilters()
    {
        $this->selectedCategory = null;
        $this->search = '';
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::where('is_published', true);

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('body', 'like', '%' . $this->search . '%')
                    ->orWhere('scripture_reference', 'like', '%' . $this->search . '%');
            });
        }

        $articles = $query->orderBy('published_at', 'desc')->paginate(9);

        return view('livewire.frontend.article.article-index', [
            'articles' => $articles,
        ])->layout('front.layouts.front-layout');
    }
}