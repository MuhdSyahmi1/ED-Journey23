<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HntecResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ocr_result_id',
        'programme',
        'cgpa',
        'context_line',
        'confidence',
    ];

    protected $casts = [
        'cgpa' => 'decimal:2',
        'confidence' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ocrResult(): BelongsTo
    {
        return $this->belongsTo(OcrResult::class);
    }

    public function getCgpaGradeColor(): string
    {
        return match (true) {
            $this->cgpa >= 3.7 => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border-green-200 dark:border-green-700',
            $this->cgpa >= 3.0 => 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-700',
            $this->cgpa >= 2.0 => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 border-yellow-200 dark:border-yellow-700',
            default => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700'
        };
    }

    public function getCgpaDescription(): string
    {
        return match (true) {
            $this->cgpa >= 3.7 => 'Distinction',
            $this->cgpa >= 3.0 => 'Merit',
            $this->cgpa >= 2.0 => 'Credit',
            default => 'Pass'
        };
    }
}