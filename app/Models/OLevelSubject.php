<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OLevelSubject extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     */
    protected $table = 'o_level_subjects';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'qualification',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'qualification' => 'string',
        ];
    }

    /**
     * Get all programme requirements that reference this O Level subject.
     */
    public function programmeRequirements(): HasMany
    {
        return $this->hasMany(ProgrammeOlevelRequirement::class);
    }

    /**
     * Scope a query to filter by qualification.
     */
    public function scopeForQualification($query, string $qualification)
    {
        return $query->where('qualification', $qualification);
    }
}