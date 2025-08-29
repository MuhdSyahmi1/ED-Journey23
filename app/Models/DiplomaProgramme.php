<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaProgramme extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'diploma_programmes';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'duration',
        'school',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'duration' => 'string',
            'school' => 'string',
        ];
    }

    /**
     * Get available duration options.
     */
    public static function getDurationOptions(): array
    {
        return ['1.0', '1.5', '2.0', '2.5', '3.0', '3.5', '4.0', '4.5', '5.0'];
    }

    /**
     * Get available school options.
     */
    public static function getSchoolOptions(): array
    {
        return [
            'School of Business',
            'School of Health Sciences',
            'School of ICT',
            'School of Science & Engineering',
            'School of Petrochemical'
        ];
    }
}