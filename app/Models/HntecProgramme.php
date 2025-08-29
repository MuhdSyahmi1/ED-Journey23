<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HntecProgramme extends Model
{
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
}