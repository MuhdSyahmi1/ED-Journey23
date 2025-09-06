<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_programme_id',
        'status',
        'preference_rank',
        'applied_at',
        'reviewed_at',
        'reviewed_by',
        'review_notes',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schoolProgramme(): BelongsTo
    {
        return $this->belongsTo(SchoolProgramme::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getPreferenceText(): string
    {
        return match ($this->preference_rank) {
            1 => '1st Choice',
            2 => '2nd Choice',
            default => 'Unknown'
        };
    }

    public function getStatusText(): string
    {
        return match ($this->status) {
            'pending' => 'Pending Review',
            'accepted' => 'Accepted',
            'rejected' => 'Rejected',
            'waitlisted' => 'Waitlisted',
            default => 'Unknown'
        };
    }

    public function getStatusColor(): string
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'accepted' => 'green',
            'rejected' => 'red',
            'waitlisted' => 'blue',
            default => 'gray'
        };
    }
}