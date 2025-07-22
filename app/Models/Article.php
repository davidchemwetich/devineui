<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'is_featured',
        'is_published',
        'published_at',
        'scripture_reference',
        'view_count',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the user that posted the article.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category the article belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the views for the article.
     */
    public function views(): HasMany
    {
        return $this->hasMany(ArticleView::class);
    }

    /**
     * Convert markdown body to HTML
     */
    protected function bodyHtml(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->body)) {
                    return '';
                }

                // Configure the Environment with desired extensions
                $config = [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                    'max_nesting_level' => 10,
                ];

                $environment = new Environment($config);
                $environment->addExtension(new CommonMarkCoreExtension());
                $environment->addExtension(new GithubFlavoredMarkdownExtension());
                $environment->addExtension(new TableExtension());

                $converter = new MarkdownConverter($environment);

                return $converter->convert($this->body)->getContent();
            }
        );
    }

    /**
     * Convert excerpt markdown to HTML (if needed)
     */
    protected function excerptHtml(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->excerpt)) {
                    return '';
                }

                $converter = new CommonMarkConverter([
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]);

                return $converter->convert($this->excerpt)->getContent();
            }
        );
    }

    /**
     * Get reading time estimate
     */
    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                $wordCount = str_word_count(strip_tags($this->body_html));
                $readingTime = ceil($wordCount / 200); // Average reading speed
                return max(1, $readingTime);
            }
        );
    }

    public function recordView($ip)
    {
        $existingView = $this->views()
            ->where('ip_address', $ip)
            ->whereDate('viewed_at', today())
            ->exists();

        if (!$existingView) {
            $this->views()->create([
                'ip_address' => $ip,
                'viewed_at' => now(),
            ]);
            $this->increment('view_count');
        }
    }
}
