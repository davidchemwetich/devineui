<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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