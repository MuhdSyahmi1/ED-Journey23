<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'subject_type',
        'case_type',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the case report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get count of pending case reports for admission staff notifications.
     */
    public static function getPendingCount(): int
    {
        return self::where('status', 'pending')->count();
    }
}