<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_category_id',
        'name',
        'role',
        'location',
        'profile_image',
        'email',
        'phone',
        'whatsapp',
        'facebook_url',
        'order',
        'status',
        'last_updated_by',
    ];

    /**
     * Get the category that the team member belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TeamCategory::class, 'team_category_id');
    }

    /**
     * Get the user who last updated this team member.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    /**
     * Get the URL for the team member's profile image.
     * Falls back to a default image if no image is available.
     *
     * @return string
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
            return url('storage/' . $this->profile_image);
        }

        // Fallback to a default image
        return asset('images/default-profile.jpg');
    }

    /**
     * Delete the old profile image when a new one is uploaded.
     *
     * @param string|null $value
     * @return void
     */
    public function setProfileImageAttribute(?string $value)
    {
        if ($this->profile_image && $value !== $this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
            Storage::disk('public')->delete($this->profile_image);
        }

        $this->attributes['profile_image'] = $value;
    }

    /**
     * Delete profile image when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function (TeamMember $teamMember) {
            if ($teamMember->profile_image && Storage::disk('public')->exists($teamMember->profile_image)) {
                Storage::disk('public')->delete($teamMember->profile_image);
            }
        });
    }
}