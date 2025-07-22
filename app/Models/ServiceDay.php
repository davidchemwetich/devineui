<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceDay extends Model
{
    use HasFactory;

    protected $fillable = ['day'];

    public function times()
    {
        return $this->hasMany(ServiceTime::class);
    }
}
