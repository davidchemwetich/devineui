<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'media_type',
        'media_path',
        'is_active',
        'order',
        'cta_primary_text',
        'cta_primary_url',
        'cta_secondary_text',
        'cta_secondary_url'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getMediaUrlAttribute()
    {
        if ($this->media_type === 'svg') {
            // SVGs can be inlined or served as files
            return $this->media_path;
        }
        return asset($this->media_path);
    }
}