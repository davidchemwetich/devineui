<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Church extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'region_id',
        'cluster_id',
        'name',
        'thumbnail',
        'google_map_iframe',
        'address',
        'phone',
        'email'
    ];

    /**
     * Get the region that this church belongs to.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the cluster that this church belongs to.
     */
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    /**
     * Get the church leaders associated with this church.
     */
    public function churchLeaders(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'church_church_leader_user')
            ->withTimestamps();
    }

    /**
     * Scope a query to order by name.
     */
    public function scopeOrderByName($query)
    {
        return $query->orderBy('name');
    }

    /**
     * Scope a query to filter churches by region.
     */
    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }

    /**
     * Scope a query to filter churches by cluster.
     */
    public function scopeInCluster($query, $clusterId)
    {
        return $query->where('cluster_id', $clusterId);
    }
}