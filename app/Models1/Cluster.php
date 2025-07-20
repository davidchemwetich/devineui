<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cluster extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['region_id', 'cluster_name'];

    /**
     * Get the region that this cluster belongs to.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the churches that belong to this cluster.
     */
    public function churches(): HasMany
    {
        return $this->hasMany(Church::class);
    }

    /**
     * Get the church count for this cluster.
     */
    public function getChurchCountAttribute(): int
    {
        return $this->churches()->count();
    }

    /**
     * Get the full cluster name including the region name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->cluster_name} ({$this->region->name})";
    }

    /**
     * Scope a query to filter clusters by region.
     */
    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }

    /**
     * Scope a query to order clusters by name.
     */
    public function scopeOrderByName($query)
    {
        return $query->orderBy('cluster_name');
    }
}