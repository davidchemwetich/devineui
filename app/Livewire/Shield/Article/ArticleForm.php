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

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:articles,slug',
        'excerpt' => 'required|string',
        'body' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'featured_image' => 'nullable|image|max:2048', // 2MB max image size
        'scripture_reference' => 'nullable|string|max:255',
        'published_at' => 'nullable|date',
    ];

    public function mount($articleId = null)
    {
        if ($articleId) {
            $this->articleId = $articleId;
            $this->loadArticle();
        } else {
            // Set default published_at to current date and time
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
        
        // Handle featured image display
        if ($article->featured_image) {
            $this->featuredImageUrl = Storage::url($article->featured_image);
        }

        // Update unique validation rule for slug when editing
        $this->rules['slug'] = 'required|string|max:255|unique:articles,slug,' . $this->articleId;
    }

    public function save()
    {
        $this->validate();

        // Handle the featured image upload
        $imagePath = null;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles/images', 'public');
        }

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

        // Only update the image path if a new image is uploaded
        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        } elseif ($this->removeImage) {
            $data['featured_image'] = null;
        }

        $article = Article::updateOrCreate(
            ['id' => $this->articleId],
            $data
        );

        // Instead of emit(), use dispatch() in Livewire v3
        $this->dispatch('article-created');

        session()->flash('message', 'Article saved successfully.');

        // Return redirect for immediate redirection
        return $this->redirect(route(config('app.admin_prefix') . '.articles.index'), navigate: true);
    }

    public function updatedTitle()
    {
        // Auto-generate slug from title if the slug is empty
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->title);
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

    // Add a custom wire:model handler for published_at to use with a datepicker
    public function updatedPublishedAt($value)
    {
        if (empty($value)) {
            $this->published_at = null;
        } else {
            try {
                // Try to parse the date
                $this->published_at = Carbon::parse($value)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                // If parsing fails, keep the original value
            }
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