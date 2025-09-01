<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammeOlevelRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_programme_id',
        'o_level_subject_id',
        'category',
        'min_grade'
    ];

    /**
     * Get the school programme that this requirement belongs to.
     */
    public function schoolProgramme(): BelongsTo
    {
        return $this->belongsTo(SchoolProgramme::class);
    }

    /**
     * Get the O Level subject that this requirement references.
     */
    public function oLevelSubject(): BelongsTo
    {
        return $this->belongsTo(OLevelSubject::class);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeCompulsory($query)
    {
        return $query->where('category', 'Compulsory');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeGeneral($query)
    {
        return $query->where('category', 'General');
    }

    /**
     * Scope a query to filter by qualification.
     */
    public function scopeForQualification($query, string $qualification)
    {
        return $query->whereHas('oLevelSubject', function($q) use ($qualification) {
            $q->where('qualification', $qualification);
        });
    }

    /**
     * Get the O Level subject name from the related subject.
     */
    public function getSubjectNameAttribute(): ?string
    {
        return $this->oLevelSubject?->name;
    }

    /**
     * Get the qualification from the related subject.
     */
    public function getQualificationAttribute(): ?string
    {
        return $this->oLevelSubject?->qualification;
    }

    /**
     * Check if this requirement is compulsory.
     */
    public function getIsCompulsoryAttribute(): bool
    {
        return $this->category === 'Compulsory';
    }

    /**
     * Get grade value for comparison (A* = 8, A = 7, B = 6, etc.)
     */
    public function getGradeValueAttribute(): int
    {
        return match($this->min_grade) {
            'A*' => 8,
            'A(a)' => 7,
            'B(b)' => 6,
            'C(c)' => 5,
            'D(d)' => 4,
            'E(e)' => 3,
            'F(f)' => 2,
            'U' => 1,
            default => 0
        };
    }
}