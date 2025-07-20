<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinistryEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id',
        'title',
        'description',
        'event_date',
        'location',
        'location_url',
        'coordinates'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'coordinates' => 'array',
    ];

    public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }

    // Helper method to get Google Maps embed URL
    public function getMapEmbedUrl(): string
    {
        if ($this->coordinates) {
            $lat = $this->coordinates['lat'] ?? null;
            $lng = $this->coordinates['lng'] ?? null;

            if ($lat && $lng) {
                return "https://www.google.com/maps/embed/v1/place?key=" . config('services.google.maps_api_key') . "&q={$lat},{$lng}&zoom=15";
            }
        }

        // Fallback to location string if coordinates not available
        if ($this->location) {
            return "https://www.google.com/maps/embed/v1/place?key=" . config('services.google.maps_api_key') . "&q=" . urlencode($this->location) . "&zoom=15";
        }

        return "";
    }
}