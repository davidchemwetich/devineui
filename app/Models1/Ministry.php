<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Ministry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'leader_id',
        'leader_contact',
        'primary_image',
        'gallery_images',
        'activities'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gallery_images' => 'array',
        'leader_id' => 'integer',
    ];

    /**
     * Default attribute values.
     *
     * @var array
     */
    protected $attributes = [
        'description' => null,
        'leader_id' => null,
        'leader_contact' => null,
        'primary_image' => null,
        'gallery_images' => '[]', // Initialize as empty JSON array
        'activities' => null,
    ];

    /**
     * Get the properly formatted primary image URL
     *
     * @return string
     */
    public function getPrimaryImageUrlAttribute()
    {
        if (empty($this->primary_image)) {
            return asset('images/defaults/ministry-placeholder.jpg');
        }
        
        return asset('storage/' . $this->primary_image);
    }

    /**
     * Get properly formatted gallery image URLs
     *
     * @return array
     */
    public function getFormattedGalleryImagesAttribute()
    {
        if (empty($this->gallery_images)) {
            return [];
        }
        
        return collect($this->gallery_images)->filter()->map(function($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    /**
     * Store a primary image for the ministry
     *
     * @param UploadedFile $file
     * @return string|null The stored file path
     */
    public function storePrimaryImage(UploadedFile $file)
    {
        if (!$file) {
            return null;
        }
        
        // Remove old image if exists
        if ($this->primary_image) {
            Storage::disk('public')->delete($this->primary_image);
        }
        
        // Store in the public disk under ministries folder
        $path = $file->store('ministries', 'public');
        
        $this->primary_image = $path;
        $this->save();
        
        return $path;
    }

    /**
     * Add a new image to the ministry gallery
     *
     * @param UploadedFile $file
     * @return string|false The stored file path or false on failure
     */
    public function addGalleryImage(UploadedFile $file)
    {
        if (!$file) {
            return false;
        }
        
        $path = $file->store('ministries/gallery', 'public');
        
        // Initialize gallery_images as empty array if null
        $galleryImages = $this->gallery_images ?? [];
        $galleryImages[] = $path;
        
        $this->gallery_images = $galleryImages;
        $this->save();
        
        return $path;
    }

    /**
     * Remove an image from the gallery
     *
     * @param string $path The image path to remove
     * @return bool Success status
     */
    public function removeGalleryImage($path)
    {
        $galleryImages = $this->gallery_images ?? [];
        
        // Find the image in the gallery
        $key = array_search($path, $galleryImages);
        
        if ($key !== false) {
            // Remove the file from storage
            Storage::disk('public')->delete($path);
            
            // Remove from the array
            unset($galleryImages[$key]);
            
            // Reindex array and save
            $this->gallery_images = array_values($galleryImages);
            $this->save();
            
            return true;
        }
        
        return false;
    }

    /**
     * Get the leader associated with the ministry.
     */
    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    /**
     * Get the events for the ministry.
     */
    public function events(): HasMany
    {
        return $this->hasMany(MinistryEvent::class);
    }

    /**
     * Clean up storage when a ministry is deleted
     */
    public static function boot()
    {
        parent::boot();
        
        static::deleting(function($ministry) {
            // Delete primary image
            if ($ministry->primary_image) {
                Storage::disk('public')->delete($ministry->primary_image);
            }
            
            // Delete all gallery images
            if ($ministry->gallery_images) {
                foreach ($ministry->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }
}