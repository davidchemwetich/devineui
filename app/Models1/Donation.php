<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'donations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'development_id',
        'user_id',
        'amount',
        'donated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'donated_at' => 'datetime',
    ];

    /**
     * Get the development project associated with the donation.
     */
    public function development()
    {
        return $this->belongsTo(Development::class, 'development_id');
    }

    /**
     * Get the user who made the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}