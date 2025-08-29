<?php

namespace Database\Seeders;

use App\Models\HntecProgramme;
use Illuminate\Database\Seeder;

class HntecProgrammesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programmes = [
            'HNTec in Construction Engineering',
            'HNTec in Geomatics',
            'HNTec in Interior Design',
            'HNTec in Building Services Engineering',
            'HNTec in Instrumentation and Control Engineering',
            'HNTec in Mechanical Engineering',
            'HNTec in Plant Engineering',
            'HNTec in Automobile Technology',
            'HNTec in Electrical Engineering',
            'HNTec in Business and Finance',
            'HNTec in Office Administration',
            'HNTec in Hospitality Operations',
            'HNTec in Travel and Tourism',
            'HNTec in Computer Networking',
            'HNTec in Information Technology',
            'HNTec in Information and Library Studies',
            'HNTec in Telecommunication Systems',
            'HNTec in Aircraft Maintenance Engineering (Avionics)',
            'HNTec in Aircraft Maintenance Engineering (Airframe & Engine)',
            'HNTec in Electronic Engineering',
            'HNTec in Electronics and Media Technology',
            'HNTec in Construction & Draughting (Dual TVET)',
            'HNTec in Real Estate Management & Agency',
            'HNTec in Agrotechnology',
            'HNTec in Aquaculture Technology',
            'HNTec in Food Science and Technology',
            'HNTec in Applied Sciences',
        ];

        // Insert all programmes, but skip if name already exists
        foreach ($programmes as $programmeName) {
            HntecProgramme::firstOrCreate(
                ['name' => $programmeName],
                ['name' => $programmeName]
            );
        }
    }
}