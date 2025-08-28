<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGrade extends Model
{
    protected $fillable = [
        'user_id',
        'ocr_result_id',
        'subject',
        'syllabus',
        'grade',
        'context_line',
        'confidence',
    ];

    protected function casts(): array
    {
        return [
            'confidence' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ocrResult(): BelongsTo
    {
        return $this->belongsTo(OcrResult::class);
    }

    public function getGradeColor(): string
    {
        return match ($this->grade) {
            'A' => 'bg-green-500 text-white',
            'B' => 'bg-blue-500 text-white',
            'C' => 'bg-yellow-500 text-white',
            'D' => 'bg-orange-500 text-white',
            'E' => 'bg-red-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    public function getGradeDescription(): string
    {
        return match ($this->grade) {
            'A' => 'Excellent',
            'B' => 'Good',
            'C' => 'Satisfactory',
            'D' => 'Pass',
            'E' => 'Weak Pass',
            default => 'Unknown',
        };
    }
}
