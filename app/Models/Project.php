<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_type_id',
        'title',
        'slug',
        'description',
        'featured_image',
        'goal_amount',
        'raised_amount',
        'latest_update',
        'latest_update_date',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'latest_update_date' => 'date',
    ];

    // Auto-generate slug when creating
    protected static function booted()
    {
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    // Accessors
    public function getProgressPercentageAttribute(): float
    {
        return $this->goal_amount > 0
            ? min(100, ($this->raised_amount / $this->goal_amount) * 100)
            : 0;
    }

    public function getFormattedGoalAttribute(): string
    {
        return number_format($this->goal_amount, 2);
    }

    public function getFormattedRaisedAttribute(): string
    {
        return number_format($this->raised_amount, 2);
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : asset('images/default-project.jpg');
    }
}