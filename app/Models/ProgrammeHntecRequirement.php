<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammeHntecRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_programme_id',
        'hntec_programme_id',
        'category',
        'min_cgpa'
    ];

    protected $casts = [
        'min_cgpa' => 'decimal:2'
    ];

    /**
     * Get the school programme that this requirement belongs to.
     */
    public function schoolProgramme(): BelongsTo
    {
        return $this->belongsTo(SchoolProgramme::class);
    }

    /**
     * Get the HNTec programme that this requirement references.
     */
    public function hntecProgramme(): BelongsTo
    {
        return $this->belongsTo(HntecProgramme::class);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeRelevant($query)
    {
        return $query->where('category', 'Relevant');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeNotRelevant($query)
    {
        return $query->where('category', 'Not Relevant');
    }

    /**
     * Scope a query to filter by minimum CGPA.
     */
    public function scopeMinimumCgpa($query, float $cgpa)
    {
        return $query->where('min_cgpa', '>=', $cgpa);
    }

    /**
     * Get the HNTec programme name from the related programme.
     */
    public function getHntecProgrammeNameAttribute(): ?string
    {
        return $this->hntecProgramme?->name;
    }

    /**
     * Check if this requirement is relevant.
     */
    public function getIsRelevantAttribute(): bool
    {
        return $this->category === 'Relevant';
    }
}