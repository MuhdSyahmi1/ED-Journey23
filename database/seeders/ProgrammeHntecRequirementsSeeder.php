<?php

namespace Database\Seeders;

use App\Models\ProgrammeHntecRequirement;
use App\Models\SchoolProgramme;
use App\Models\HntecProgramme;
use App\Models\DiplomaProgramme;
use Illuminate\Database\Seeder;

class ProgrammeHntecRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define HNTec requirements for each programme category
        $hntecRequirements = [
            // Business School Programmes
            'business' => [
                'Diploma in Business Accounting & Finance' => [
                    'relevant' => [
                        'Higher National Diploma in Accounting & Finance' => 2.5,
                        'Higher National Diploma in Business Studies' => 2.0,
                        'Higher National Diploma in Banking & Finance' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ],
                'Diploma in Entrepreneurship & Marketing Strategies' => [
                    'relevant' => [
                        'Higher National Diploma in Marketing' => 2.5,
                        'Higher National Diploma in Business Studies' => 2.0,
                        'Higher National Diploma in Management' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Science & Technology' => 3.2,
                    ]
                ],
                'Diploma in Human Capital Management' => [
                    'relevant' => [
                        'Higher National Diploma in Management' => 2.5,
                        'Higher National Diploma in Business Studies' => 2.0,
                        'Higher National Diploma in Public Administration' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.5,
                    ]
                ],
                'Diploma in Business Studies' => [
                    'relevant' => [
                        'Higher National Diploma in Business Studies' => 2.0,
                        'Higher National Diploma in Management' => 2.3,
                        'Higher National Diploma in Marketing' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.8,
                        'Higher National Diploma in Science & Technology' => 3.0,
                    ]
                ]
            ],

            // ICT School Programmes
            'ict' => [
                'Diploma in Data Analytics' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Information Technology' => 2.3,
                        'Higher National Diploma in Mathematics & Statistics' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ],
                'Diploma in Web Technology / Web Development' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.3,
                        'Higher National Diploma in Information Technology' => 2.5,
                        'Higher National Diploma in Software Engineering' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Science & Technology' => 3.2,
                    ]
                ],
                'Diploma in Applications Development' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Software Engineering' => 2.3,
                        'Higher National Diploma in Information Technology' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ],
                'Diploma in Digital Arts & Media' => [
                    'relevant' => [
                        'Higher National Diploma in Multimedia & Digital Arts' => 2.3,
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Arts & Design' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Science & Technology' => 3.2,
                    ]
                ],
                'Diploma in Information Systems' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Information Technology' => 2.3,
                        'Higher National Diploma in Information Systems' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ],
                'Diploma in Cloud & Networking' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Information Technology' => 2.3,
                        'Higher National Diploma in Network Engineering' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Science & Technology' => 3.2,
                    ]
                ],
                'Diploma in Digital Media' => [
                    'relevant' => [
                        'Higher National Diploma in Multimedia & Digital Arts' => 2.3,
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Arts & Design' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ],
                'Diploma in IT Network' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Network Engineering' => 2.3,
                        'Higher National Diploma in Information Technology' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Science & Technology' => 3.2,
                    ]
                ],
                'Diploma in Library Informatics Computing' => [
                    'relevant' => [
                        'Higher National Diploma in Computer Studies' => 2.5,
                        'Higher National Diploma in Information Technology' => 2.3,
                        'Higher National Diploma in Library Science' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Business Studies' => 3.0,
                        'Higher National Diploma in Engineering' => 3.2,
                    ]
                ]
            ],

            // Health School Programmes
            'health' => [
                'Diploma in Health Science (Nursing)' => [
                    'relevant' => [
                        'Higher National Diploma in Nursing' => 2.5,
                        'Higher National Diploma in Health Sciences' => 2.3,
                        'Higher National Diploma in Medical Laboratory Science' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Health Science (Midwifery)' => [
                    'relevant' => [
                        'Higher National Diploma in Nursing' => 2.3,
                        'Higher National Diploma in Health Sciences' => 2.5,
                        'Higher National Diploma in Midwifery' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Health Science (Paramedic)' => [
                    'relevant' => [
                        'Higher National Diploma in Health Sciences' => 2.5,
                        'Higher National Diploma in Emergency Medical Services' => 2.3,
                        'Higher National Diploma in Medical Laboratory Science' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ]
            ],

            // Engineering School Programmes
            'engineering' => [
                'Diploma in Architecture' => [
                    'relevant' => [
                        'Higher National Diploma in Civil Engineering' => 2.5,
                        'Higher National Diploma in Building Technology' => 2.3,
                        'Higher National Diploma in Architecture' => 2.3,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Interior Design' => [
                    'relevant' => [
                        'Higher National Diploma in Arts & Design' => 2.3,
                        'Higher National Diploma in Building Technology' => 2.5,
                        'Higher National Diploma in Architecture' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Business Studies' => 3.2,
                    ]
                ],
                'Diploma in Civil Engineering' => [
                    'relevant' => [
                        'Higher National Diploma in Civil Engineering' => 2.3,
                        'Higher National Diploma in Building Technology' => 2.5,
                        'Higher National Diploma in Engineering' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Electrical Engineering / Electronic & Communication Engineering' => [
                    'relevant' => [
                        'Higher National Diploma in Electrical Engineering' => 2.3,
                        'Higher National Diploma in Electronics Engineering' => 2.3,
                        'Higher National Diploma in Engineering' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Mechanical Engineering' => [
                    'relevant' => [
                        'Higher National Diploma in Mechanical Engineering' => 2.3,
                        'Higher National Diploma in Engineering' => 2.5,
                        'Higher National Diploma in Manufacturing Technology' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ],
                'Diploma in Petroleum Engineering' => [
                    'relevant' => [
                        'Higher National Diploma in Petroleum Engineering' => 2.3,
                        'Higher National Diploma in Chemical Engineering' => 2.5,
                        'Higher National Diploma in Engineering' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.2,
                        'Higher National Diploma in Business Studies' => 3.5,
                    ]
                ]
            ],

            // Petrochemical School Programmes
            'petrochemical' => [
                'Diploma in Applied Science Technology' => [
                    'relevant' => [
                        'Higher National Diploma in Science & Technology' => 2.3,
                        'Higher National Diploma in Chemical Engineering' => 2.5,
                        'Higher National Diploma in Laboratory Technology' => 2.5,
                    ],
                    'not_relevant' => [
                        'Higher National Diploma in Computer Studies' => 3.0,
                        'Higher National Diploma in Business Studies' => 3.2,
                    ]
                ]
            ]
        ];

        foreach ($hntecRequirements as $school => $programmes) {
            foreach ($programmes as $programmeName => $requirements) {
                // Find the school programme
                $diplomaProgramme = DiplomaProgramme::where('name', $programmeName)->first();
                if (!$diplomaProgramme) continue;

                $schoolProgramme = SchoolProgramme::where('diploma_programme_id', $diplomaProgramme->id)
                    ->where('school', $school)
                    ->first();
                if (!$schoolProgramme) continue;

                foreach ($requirements as $category => $hntecProgrammes) {
                    foreach ($hntecProgrammes as $hntecName => $minCgpa) {
                        // Find or create the HNTec programme
                        $hntecProgramme = HntecProgramme::firstOrCreate(['name' => $hntecName]);

                        // Create the requirement
                        ProgrammeHntecRequirement::firstOrCreate(
                            [
                                'school_programme_id' => $schoolProgramme->id,
                                'hntec_programme_id' => $hntecProgramme->id,
                            ],
                            [
                                'category' => ucfirst(str_replace('_', ' ', $category)),
                                'min_cgpa' => $minCgpa,
                            ]
                        );
                    }
                }
            }
        }
    }
}