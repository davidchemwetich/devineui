<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'institution_logo',
        'favicon',
        'about',
        'address',
        'phone',
        'email',
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array'
    ];
}