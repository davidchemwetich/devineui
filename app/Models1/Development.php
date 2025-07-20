<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Development extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'developments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'status',
        'start_date',
        'end_date',
        'location',
        'featured_image',
        'target_amount',
        'amount_raised',
        'donation_link',
        'donors_count',
        'last_donation_at',
        'project_lead',
        'volunteer_needed',
        'volunteer_description',
        'tags',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string', // Enum: Building Project, Outreach, Community Event
        'status' => 'string', // Enum: Planned, Ongoing, Completed
        'start_date' => 'date',
        'end_date' => 'date',
        'target_amount' => 'decimal:2',
        'amount_raised' => 'decimal:2',
        'last_donation_at' => 'datetime',
        'volunteer_needed' => 'boolean',
        'tags' => 'array', // JSON cast to array
        'published_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically generate slug from title when creating/updating
        static::saving(function ($development) {
            if (empty($development->slug)) {
                $development->slug = Str::slug($development->title);
            }
        });
    }

    /**
     * Get the user who leads the project.
     */
    public function projectLead()
    {
        return $this->belongsTo(User::class, 'project_lead');
    }

    /**
     * Get the donations for the project.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class, 'development_id');
    }

    /**
     * Get the users who volunteered for the project.
     */
    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'development_user', 'development_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include published developments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}