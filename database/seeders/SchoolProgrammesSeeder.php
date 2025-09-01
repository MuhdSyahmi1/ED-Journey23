<?php

namespace Database\Seeders;

use App\Models\SchoolProgramme;
use App\Models\DiplomaProgramme;
use Illuminate\Database\Seeder;

class SchoolProgrammesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map diploma programmes to their respective schools based on DiplomaProgrammesSeeder
        $schoolMappings = [
            'business' => [
                'Diploma in Business Accounting & Finance',
                'Diploma in Entrepreneurship & Marketing Strategies',
                'Diploma in Human Capital Management',
                'Diploma in Business Studies'
            ],
            'ict' => [
                'Diploma in Data Analytics',
                'Diploma in Web Technology / Web Development',
                'Diploma in Applications Development',
                'Diploma in Digital Arts & Media',
                'Diploma in Information Systems',
                'Diploma in Cloud & Networking',
                'Diploma in Digital Media',
                'Diploma in IT Network',
                'Diploma in Library Informatics Computing'
            ],
            'health' => [
                'Diploma in Health Science (Nursing)',
                'Diploma in Health Science (Midwifery)',
                'Diploma in Health Science (Paramedic)'
            ],
            'engineering' => [
                'Diploma in Architecture',
                'Diploma in Interior Design',
                'Diploma in Civil Engineering',
                'Diploma in Electrical Engineering / Electronic & Communication Engineering',
                'Diploma in Mechanical Engineering',
                'Diploma in Petroleum Engineering'
            ],
            'petrochemical' => [
                'Diploma in Applied Science Technology'
            ]
        ];

        foreach ($schoolMappings as $school => $programmeNames) {
            foreach ($programmeNames as $programmeName) {
                // Find the diploma programme
                $diplomaProgramme = DiplomaProgramme::where('name', $programmeName)->first();
                
                if ($diplomaProgramme) {
                    // Create school programme entry
                    SchoolProgramme::firstOrCreate(
                        [
                            'diploma_programme_id' => $diplomaProgramme->id,
                            'school' => $school
                        ],
                        [
                            'duration' => $diplomaProgramme->duration,
                            'is_active' => true
                        ]
                    );
                }
            }
        }
    }
}