<?php

namespace App\Livewire\Frontend\Article;

use App\Models\Category;
use Livewire\Component;
use App\Models\Article;
use Livewire\Attributes\Layout;

class ArticleShow extends Component
{
    public $slug;
    public $article;
    public $relatedArticles;
    public $categories;
    public $isLoading = true;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $this->article->recordView(request()->ip());

        // Get related articles from the same category
        $this->relatedArticles = Article::where('category_id', $this->article->category_id)
            ->where('id', '!=', $this->article->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $this->categories = Category::withCount(['articles' => function ($query) {
            $query->where('is_published', true);
        }])->get();

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.frontend.article.article-show')->layout('web.layouts.front-layout');
    }
}