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

        // Accessor for institution_logo URL
        public function getInstitutionLogoUrlAttribute()
        {
            return $this->institution_logo ? asset('storage/' . $this->institution_logo) : asset('default-logo.png');
        }
    
        // Accessor for favicon URL
        public function getFaviconUrlAttribute()
        {
            return $this->favicon ? asset('storage/' . $this->favicon) : asset('default-favicon.ico');
        }
        
}