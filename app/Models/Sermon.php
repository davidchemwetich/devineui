<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Sermon extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'preached_on',
        'audio_path',
        'video_url',
        'pdf_path',
        'cover_image',
        'is_featured',
        'category',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'preached_on' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-delete associated files when sermon is force deleted
        static::forceDeleted(function ($sermon) {
            $sermon->deleteAssociatedFiles();
        });
    }

    /**
     * Get the user that created the sermon.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Published sermons only
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Featured sermons only
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: By category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: Recent sermons (ordered by preached_on date)
     */
    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('preached_on', 'desc');
    }

    /**
     * Get the formatted preached date
     */
    public function getFormattedDateAttribute(): ?string
    {
        return $this->preached_on?->format('F j, Y');
    }

    /**
     * Get the short formatted preached date
     */
    public function getShortDateAttribute(): ?string
    {
        return $this->preached_on?->format('M j, Y');
    }

    /**
     * Get the public URL for the audio file
     */
    public function getAudioUrlAttribute(): ?string
    {
        return $this->audio_path ? Storage::url($this->audio_path) : null;
    }

    /**
     * Get the public URL for the PDF file
     */
    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? Storage::url($this->pdf_path) : null;
    }

    /**
     * Get the public URL for the cover image
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->cover_image ? Storage::url($this->cover_image) : null;
    }

    /**
     * Get YouTube video embed URL
     */
    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // Extract video ID from various YouTube URL formats
        $videoId = $this->extractYouTubeVideoId($this->video_url);

        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
    }

    /**
     * Get YouTube video thumbnail
     */
    public function getVideoThumbnailAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        $videoId = $this->extractYouTubeVideoId($this->video_url);

        return $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
    }

    /**
     * Check if sermon has audio
     */
    public function hasAudio(): bool
    {
        return !empty($this->audio_path) && Storage::disk('public')->exists($this->audio_path);
    }

    /**
     * Check if sermon has video
     */
    public function hasVideo(): bool
    {
        return !empty($this->video_url);
    }

    /**
     * Check if sermon has PDF
     */
    public function hasPdf(): bool
    {
        return !empty($this->pdf_path) && Storage::disk('public')->exists($this->pdf_path);
    }

    /**
     * Check if sermon has cover image
     */
    public function hasCoverImage(): bool
    {
        return !empty($this->cover_image) && Storage::disk('public')->exists($this->cover_image);
    }

    /**
     * Get file size for audio in human readable format
     */
    public function getAudioSizeAttribute(): ?string
    {
        if (!$this->hasAudio()) {
            return null;
        }

        $bytes = Storage::disk('public')->size($this->audio_path);
        return $this->formatBytes($bytes);
    }

    /**
     * Get file size for PDF in human readable format
     */
    public function getPdfSizeAttribute(): ?string
    {
        if (!$this->hasPdf()) {
            return null;
        }

        $bytes = Storage::disk('public')->size($this->pdf_path);
        return $this->formatBytes($bytes);
    }

    /**
     * Get duration of audio file (requires getID3 or similar library)
     * This is a placeholder - implement based on your audio processing needs
     */
    public function getAudioDurationAttribute(): ?string
    {
        // Implement audio duration extraction if needed
        // You might want to store this in the database for better performance
        return null;
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'published' => 'green',
            'draft' => 'yellow',
            default => 'gray'
        };
    }

    /**
     * Get category color for UI
     */
    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'Faith' => 'blue',
            'Family' => 'green',
            'End Times' => 'red',
            'Worship' => 'purple',
            'Prayer' => 'indigo',
            default => 'gray'
        };
    }

    /**
     * Delete associated files from storage
     */
    public function deleteAssociatedFiles(): void
    {
        $files = array_filter([
            $this->audio_path,
            $this->pdf_path,
            $this->cover_image
        ]);

        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }
    }

    /**
     * Extract YouTube video ID from URL
     */
    private function extractYouTubeVideoId(string $url): ?string
    {
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/v\/([a-zA-Z0-9_-]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Get available categories
     */
    public static function getCategories(): array
    {
        return [
            'Faith',
            'Family',
            'End Times',
            'Worship',
            'Prayer',
            'Other'
        ];
    }

    /**
     * Get available statuses
     */
    public static function getStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published'
        ];
    }
}