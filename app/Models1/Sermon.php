<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'preached_on' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user that created the sermon.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the formatted preached date
     */
    public function getPreachedDateAttribute()
    {
        return $this->preached_on ? $this->preached_on->format('F j, Y') : null;
    }
    
    /**
     * Get the public URL for the audio file
     */
    public function getAudioUrlAttribute()
    {
        return $this->audio_path ? asset('storage/' . $this->audio_path) : null;
    }
    
    /**
     * Get the public URL for the PDF file
     */
    public function getPdfUrlAttribute()
    {
        return $this->pdf_path ? asset('storage/' . $this->pdf_path) : null;
    }
    
    /**
     * Get the public URL for the cover image
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }
}