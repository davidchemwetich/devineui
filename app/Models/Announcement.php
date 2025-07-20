<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'message',
        'announcement_date',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'announcement_date' => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * Scope a query to only include published announcements.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    /**
     * Scope a query to only include current and future announcements.
     */
    public function scopeCurrent(Builder $query): void
    {
        $query->where('announcement_date', '>=', now()->toDateString());
    }

    /**
     * Get the rendered markdown content.
     */
    public function getFormattedMessageAttribute(): string
    {
        return \Illuminate\Support\Str::markdown($this->message);
    }
}