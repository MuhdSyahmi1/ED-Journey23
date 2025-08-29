<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ALevelSubject extends Model
{
    protected $fillable = [
        'name',
        'qualification',
    ];

    protected function casts(): array
    {
        return [
            'qualification' => 'string',
        ];
    }
}
