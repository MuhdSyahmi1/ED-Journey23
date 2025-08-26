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
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Feedback $feedback) {
            // Auto-set priority based on feedback_type if not already set
            if (empty($feedback->priority) && !empty($feedback->feedback_type)) {
                $feedback->priority = self::getAutoPriority($feedback->feedback_type);
            }
        });

        static::updating(function (Feedback $feedback) {
            // Auto-update priority if feedback_type changes
            if ($feedback->isDirty('feedback_type')) {
                $feedback->priority = self::getAutoPriority($feedback->feedback_type);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',
        'feedback_type',
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
     * Scope for filtering by feedback type
     */
    public function scopeByFeedbackType($query, $type)
    {
        return $query->where('feedback_type', $type);
    }

    public function scopeTechnicalIssue($query)
    {
        return $query->where('feedback_type', 'technical_issue');
    }

    public function scopeContentError($query)
    {
        return $query->where('feedback_type', 'content_error');
    }

    public function scopeFeatureRequest($query)
    {
        return $query->where('feedback_type', 'feature_request');
    }

    public function scopeUsabilityFeedback($query)
    {
        return $query->where('feedback_type', 'usability_feedback');
    }

    public function scopeCourseFeedback($query)
    {
        return $query->where('feedback_type', 'course_feedback');
    }

    public function scopeGeneralFeedback($query)
    {
        return $query->where('feedback_type', 'general_feedback');
    }

    public function scopeAccountBilling($query)
    {
        return $query->where('feedback_type', 'account_billing');
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
     * Get feedback type display names
     */
    public function getFeedbackTypeDisplayAttribute(): string
    {
        return match($this->feedback_type) {
            'technical_issue' => 'Technical Issue / Bug',
            'content_error' => 'Content Error',
            'feature_request' => 'Feature Request / Suggestion',
            'usability_feedback' => 'Usability / User Experience Feedback',
            'course_feedback' => 'Course / Instructor Feedback',
            'general_feedback' => 'General Feedback / Other',
            'account_billing' => 'Account / Billing Issue',
            default => 'General Feedback',
        };
    }

    /**
     * Get feedback type color for UI display
     */
    public function getFeedbackTypeColorAttribute(): string
    {
        return match($this->feedback_type) {
            'technical_issue' => 'bg-red-100 text-red-800',
            'content_error' => 'bg-orange-100 text-orange-800',
            'feature_request' => 'bg-blue-100 text-blue-800',
            'usability_feedback' => 'bg-purple-100 text-purple-800',
            'course_feedback' => 'bg-green-100 text-green-800',
            'general_feedback' => 'bg-gray-100 text-gray-800',
            'account_billing' => 'bg-pink-100 text-pink-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Auto-compute priority based on feedback type
     */
    public static function getAutoPriority(string $feedbackType): string
    {
        return match($feedbackType) {
            'technical_issue' => 'high',      // Technical Issue / Bug -> High Priority
            'account_billing' => 'high',      // Account / Billing Issue -> High Priority
            'content_error' => 'medium',      // Content Error -> Medium Priority
            'course_feedback' => 'medium',    // Course / Instructor Feedback -> Medium Priority
            'feature_request' => 'low',       // Feature Request / Suggestion -> Low Priority
            'usability_feedback' => 'low',    // Usability / User Experience Feedback -> Low Priority
            'general_feedback' => 'low',      // General Feedback / Other -> Low Priority
            default => 'medium',
        };
    }

    /**
     * Get all feedback types as array for forms
     */
    public static function getFeedbackTypes(): array
    {
        return [
            'technical_issue' => 'Technical Issue / Bug',
            'content_error' => 'Content Error', 
            'feature_request' => 'Feature Request / Suggestion',
            'usability_feedback' => 'Usability / User Experience Feedback',
            'course_feedback' => 'Course / Instructor Feedback',
            'general_feedback' => 'General Feedback / Other',
            'account_billing' => 'Account / Billing Issue',
        ];
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