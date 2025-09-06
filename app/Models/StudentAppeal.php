<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAppeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_application_id',
        'appeal_reason',
        'supporting_documents',
        'status',
        'admin_response',
        'reviewed_by',
        'reviewed_at'
    ];

    protected $casts = [
        'supporting_documents' => 'array',
        'reviewed_at' => 'datetime'
    ];

    /**
     * Get the user who submitted the appeal
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the original student application
     */
    public function studentApplication(): BelongsTo
    {
        return $this->belongsTo(StudentApplication::class);
    }

    /**
     * Get the admin who reviewed the appeal
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get status display text
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending Review',
            'under_review' => 'Under Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Unknown'
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'under_review' => 'blue',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    /**
     * Check if appeal can be reviewed
     */
    public function canBeReviewed(): bool
    {
        return in_array($this->status, ['pending', 'under_review']);
    }

    /**
     * Check if appeal is completed
     */
    public function isCompleted(): bool
    {
        return in_array($this->status, ['approved', 'rejected']);
    }

    /**
     * Scope for pending appeals
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for under review appeals
     */
    public function scopeUnderReview($query)
    {
        return $query->where('status', 'under_review');
    }

    /**
     * Scope for completed appeals
     */
    public function scopeCompleted($query)
    {
        return $query->whereIn('status', ['approved', 'rejected']);
    }
}