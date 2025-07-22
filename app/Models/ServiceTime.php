<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_day_id',
        'time',
        'name',
        'language',
    ];

    public function day()
    {
        return $this->belongsTo(ServiceDay::class, 'service_day_id');
    }
}