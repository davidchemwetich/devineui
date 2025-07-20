<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'heading',
        'subheading',
        'content',
        'mission_statement',
        'vision_statement',
        'image_path',
        'youtube_url',
        'meta_description',
        'meta_keywords',
        'last_updated_by'
    ];


    public function getContentPreview($length = 150)
    {
        return Str::limit(strip_tags($this->content), $length);
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function getYoutubeIdAttribute()
    {
        if (!$this->youtube_url) return null;

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->youtube_url, $matches);
        return $matches[1] ?? null;
    }

    public function missionPoints()
    {
        return $this->splitPoints($this->mission_statement);
    }

    public function visionPoints()
    {
        return $this->splitPoints($this->vision_statement);
    }

    protected function splitPoints($text)
    {
        if (empty($text)) return [];

        return collect(preg_split('/\r\n|\r|\n|•/', $text))
            ->map(fn($point) => trim($point))
            ->filter()
            ->toArray();
    }
}