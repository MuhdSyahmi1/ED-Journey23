<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolProgramme extends Model
{
    use HasFactory;

    protected $fillable = [
        'diploma_programme_id',
        'school',
        'duration',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the diploma programme that this school programme belongs to.
     */
    public function diplomaProgramme(): BelongsTo
    {
        return $this->belongsTo(DiplomaProgramme::class);
    }

    /**
     * Get all HNTec requirements for this school programme.
     */
    public function hntecRequirements(): HasMany
    {
        return $this->hasMany(ProgrammeHntecRequirement::class);
    }

    /**
     * Get all O Level requirements for this school programme.
     */
    public function oLevelRequirements(): HasMany
    {
        return $this->hasMany(ProgrammeOlevelRequirement::class);
    }

    /**
     * Scope a query to only include active programmes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by school.
     */
    public function scopeForSchool($query, string $school)
    {
        return $query->where('school', $school);
    }

    /**
     * Get the school name in a human-readable format.
     */
    public function getSchoolNameAttribute(): string
    {
        return match($this->school) {
            'business' => 'School of Business',
            'health' => 'School of Health Sciences',
            'ict' => 'School of Information and Communication Technology',
            'engineering' => 'School of Science & Engineering',
            'petrochemical' => 'School of Petrochemical',
            default => ucfirst($this->school)
        };
    }

    /**
     * Get the programme name from the related diploma programme.
     */
    public function getProgrammeNameAttribute(): ?string
    {
        return $this->diplomaProgramme?->name;
    }
}