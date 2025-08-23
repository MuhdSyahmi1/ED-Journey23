<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'feedback';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',
        'priority',
        'admin_reply',
        'replied_by',
        'replied_at',
        'resolved_at',
        'attachments',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
            'resolved_at' => 'datetime',
            'attachments' => 'array',
        ];
    }

    /**
     * Get the user who submitted this feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who replied to this feedback.
     */
    public function repliedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Scope for filtering by status
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in-progress');
    }

    public function scopeSolved($query)
    {
        return $query->where('status', 'solved');
    }

    /**
     * Scope for filtering by priority
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    public function scopeMediumPriority($query)
    {
        return $query->where('priority', 'medium');
    }

    public function scopeLowPriority($query)
    {
        return $query->where('priority', 'low');
    }

    /**
     * Get status color for UI display
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in-progress' => 'bg-blue-100 text-blue-800',
            'solved' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get priority color for UI display
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'high' => 'bg-red-100 text-red-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get formatted status text
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'in-progress' => 'In Progress',
            'solved' => 'Solved',
            default => 'Unknown',
        };
    }

    /**
     * Get formatted priority text
     */
    public function getPriorityDisplayAttribute(): string
    {
        return ucfirst($this->priority);
    }

    /**
     * Check if feedback has been replied to
     */
    public function hasReply(): bool
    {
        return !is_null($this->admin_reply) && !is_null($this->replied_at);
    }

    /**
     * Check if feedback is resolved
     */
    public function isResolved(): bool
    {
        return $this->status === 'solved';
    }

    /**
     * Get days since feedback was submitted
     */
    public function getDaysOldAttribute(): int
    {
        return $this->created_at->diffInDays(now());
    }
}