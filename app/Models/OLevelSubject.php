<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OLevelSubject extends Model
{
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
}