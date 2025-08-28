<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OcrResult extends Model
{
    protected $fillable = [
        'user_id',
        'filename',
        'text',
        'ocr_type',
        'confidence_data',
    ];

    protected function casts(): array
    {
        return [
            'confidence_data' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentGrades(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }
}
