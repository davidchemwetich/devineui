<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    protected $fillable = [
        'media_type',
        'media_path',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    // =============================================================================
    // VALIDATION RULES
    // =============================================================================

    public static function rules(): array
    {
        return [
            'media_type' => 'required|in:image,video',
            'media_path' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }

    // =============================================================================
    // ACCESSORS
    // =============================================================================

    public function getMediaUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->media_path);
    }

    public function getHasContentAttribute(): bool
    {
        return !empty($this->title);
    }

    // =============================================================================
    // QUERY SCOPES
    // =============================================================================

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('id', 'asc');
    }

    public function scopeDisplayReady(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('media_type', $type);
    }

    public function scopeWithTitle(Builder $query): Builder
    {
        return $query->whereNotNull('title')->where('title', '!=', '');
    }

    // =============================================================================
    // HELPER METHODS
    // =============================================================================

    public function hasValidMedia(): bool
    {
        if (empty($this->media_path)) {
            return false;
        }
        return Storage::disk('public')->exists($this->media_path);
    }

    public function getMediaMimeType(): ?string
    {
        if (!$this->hasValidMedia()) {
            return null;
        }
        return Storage::disk('public')->mimeType($this->media_path);
    }

    public function isComplete(): bool
    {
        return $this->hasValidMedia() && $this->has_content && $this->is_active;
    }

    public function hasValidMediaType(): bool
    {
        $mimeType = $this->getMediaMimeType();
        if (!$mimeType) {
            return false;
        }

        $validTypes = [
            'image' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            'video' => ['video/mp4', 'video/webm', 'video/ogg'],
        ];

        return in_array($mimeType, $validTypes[$this->media_type] ?? []);
    }

    public function getMediaSize(): ?int
    {
        if (!$this->hasValidMedia()) {
            return null;
        }
        return Storage::disk('public')->size($this->media_path);
    }

    public function getFormattedMediaSize(): ?string
    {
        $bytes = $this->getMediaSize();
        if (!$bytes) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}