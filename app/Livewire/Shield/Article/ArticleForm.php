<?php

namespace App\Livewire\Shield\Article;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArticleForm extends Component
{
    use WithFileUploads;

    public $articleId;
    public $title;
    public $slug;
    public $excerpt;
    public $body;
    public $category_id;
    public $is_featured = false;
    public $is_published = false;
    public $featured_image;
    public $featuredImageUrl;
    public $removeImage = false;
    public $scripture_reference;
    public $published_at;

    public $step = 1;
    public $totalSteps = 4;

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $this->articleId,
            'excerpt' => 'required|string|max:300',
            'body' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'scripture_reference' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ];

        // Only validate fields for the current step
        if ($this->step === 1) {
            return array_intersect_key($rules, array_flip(['title', 'slug']));
        } elseif ($this->step === 2) {
            return array_intersect_key($rules, array_flip(['excerpt', 'body']));
        } elseif ($this->step === 3) {
            return array_intersect_key($rules, array_flip(['featured_image', 'scripture_reference']));
        }

        return $rules;
    }


    public function mount($articleId = null)
    {
        if ($articleId) {
            $this->articleId = $articleId;
            $this->loadArticle();
        } else {
            $this->published_at = now()->format('Y-m-d H:i:s');
        }
    }

    public function loadArticle()
    {
        $article = Article::findOrFail($this->articleId);
        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->excerpt = $article->excerpt;
        $this->body = $article->body;
        $this->category_id = $article->category_id;
        $this->is_featured = $article->is_featured;
        $this->is_published = $article->is_published;
        $this->scripture_reference = $article->scripture_reference;
        $this->published_at = $article->published_at ? $article->published_at->format('Y-m-d H:i:s') : null;

        if ($article->featured_image) {
            $this->featuredImageUrl = Storage::url($article->featured_image);
        }
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->featured_image ? $this->featured_image->store('articles/images', 'public') : null;

        $data = [
            'user_id' => Auth::id(),
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
            'is_published' => $this->is_published,
            'scripture_reference' => $this->scripture_reference,
            'published_at' => $this->is_published && $this->published_at ? $this->published_at : null,
        ];

        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        } elseif ($this->removeImage) {
            $data['featured_image'] = null;
        }

        Article::updateOrCreate(['id' => $this->articleId], $data);

        $this->dispatch('article-created');
        session()->flash('message', 'Article saved successfully.');

        return $this->redirect(route(config('app.admin_prefix') . '.articles.index'), navigate: true);
    }

    public function updatedTitle($value)
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function clearFeaturedImage()
    {
        $this->featured_image = null;
        $this->removeImage = true;
    }

    public function removeFeaturedImage()
    {
        $this->featuredImageUrl = null;
        $this->removeImage = true;
    }

    public function updatedPublishedAt($value)
    {
        try {
            $this->published_at = Carbon::parse($value)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            // Keep original value on parsing failure
        }
    }

    public function nextStep()
    {
        $this->validate();
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.shield.article.article-form', [
            'categories' => $categories,
        ])->layout('shield.layouts.shield');
    }
}