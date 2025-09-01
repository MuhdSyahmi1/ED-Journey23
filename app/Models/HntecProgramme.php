<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HntecProgramme extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     */
    protected $table = 'hntec_programmes';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
        ];
    }

    /**
     * Get all programme requirements that reference this HNTec programme.
     */
    public function programmeRequirements(): HasMany
    {
        return $this->hasMany(ProgrammeHntecRequirement::class);
    }
}