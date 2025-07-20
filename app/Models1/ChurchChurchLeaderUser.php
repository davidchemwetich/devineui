<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChurchChurchLeaderUser extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'church_church_leader_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'church_id',
        'user_id',
    ];

    /**
     * Get the church that belongs to this relationship.
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    /**
     * Get the user (church leader) that belongs to this relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}