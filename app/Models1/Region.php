<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the clusters that belong to this region.
     */
    public function clusters(): HasMany
    {
        return $this->hasMany(Cluster::class);
    }

    /**
     * Get the churches directly associated with this region.
     */
    public function churches(): HasMany
    {
        return $this->hasMany(Church::class);
    }

    /**
     * Get the total number of churches in this region.
     */
    public function getChurchCountAttribute(): int
    {
        return $this->churches()->count();
    }

    /**
     * Get the total number of clusters in this region.
     */
    public function getClusterCountAttribute(): int
    {
        return $this->clusters()->count();
    }

    /**
     * Scope a query to order regions by name.
     */
    public function scopeOrderByName($query)
    {
        return $query->orderBy('name');
    }
}