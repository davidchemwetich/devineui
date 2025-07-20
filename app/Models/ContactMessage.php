<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'priority',
        'ip_address',
        'user_agent',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    public function markAsRead()
    {
        return $this->update(['read_at' => now(), 'status' => 'read']);
    }

    public function markAsUnread()
    {
        return $this->update(['read_at' => null, 'status' => 'unread']);
    }
}
