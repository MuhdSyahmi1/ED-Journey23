<?php

namespace Database\Seeders;

use App\Models\ProgrammeOlevelRequirement;
use App\Models\SchoolProgramme;
use App\Models\OLevelSubject;
use App\Models\DiplomaProgramme;
use Illuminate\Database\Seeder;

class ProgrammeOlevelRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define O-Level requirements for each programme category
        // Note: Categories are limited to 'Compulsory' or 'General'
        // Grades follow format: 'A*', 'A(a)', 'B(b)', 'C(c)', 'D(d)', 'E(e)', 'F(f)', 'U'
        
        $olevelRequirements = [
            // Business School Programmes
            'business' => [
                'Diploma in Business Accounting & Finance' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Accounting' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Economics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Business Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Commerce' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Entrepreneurship & Marketing Strategies' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Business Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Economics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Commerce' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Accounting' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Human Capital Management' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Business Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Economics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Accounting' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'History' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Business Studies' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Business Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Economics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Accounting' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Commerce' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ]
            ],

            // ICT School Programmes
            'ict' => [
                'Diploma in Data Analytics' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Statistics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ]
                ],
                'Diploma in Web Technology / Web Development' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Art' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Applications Development' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Digital Arts & Media' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Art' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Information Systems' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Business Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Accounting' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Cloud & Networking' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ]
                ],
                'Diploma in Digital Media' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Art' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in IT Network' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ]
                ],
                'Diploma in Library Informatics Computing' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Information Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'English Literature' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'History' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ]
            ],

            // Health School Programmes
            'health' => [
                'Diploma in Health Science (Nursing)' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Biology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Health Science (Midwifery)' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Biology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Health Science (Paramedic)' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Biology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ]
            ],

            // Engineering School Programmes
            'engineering' => [
                'Diploma in Architecture' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Art' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Interior Design' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Art' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Civil Engineering' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Electrical Engineering / Electronic & Communication Engineering' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Computer Studies' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Mechanical Engineering' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Design & Technology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ],
                'Diploma in Petroleum Engineering' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Biology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ]
                ]
            ],

            // Petrochemical School Programmes
            'petrochemical' => [
                'Diploma in Applied Science Technology' => [
                    'Compulsory' => [
                        'English Language' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                        'Physics' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Chemistry' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                    ],
                    'General' => [
                        'Biology' => ['IGCSE' => 'C(c)', 'GCE' => 'C(c)'],
                        'Additional Mathematics' => ['IGCSE' => 'B(b)', 'GCE' => 'B(b)'],
                    ]
                ]
            ]
        ];

        foreach ($olevelRequirements as $school => $programmes) {
            foreach ($programmes as $programmeName => $requirements) {
                // Find the school programme
                $diplomaProgramme = DiplomaProgramme::where('name', $programmeName)->first();
                if (!$diplomaProgramme) continue;

                $schoolProgramme = SchoolProgramme::where('diploma_programme_id', $diplomaProgramme->id)
                    ->where('school', $school)
                    ->first();
                if (!$schoolProgramme) continue;

                foreach ($requirements as $category => $subjects) {
                    foreach ($subjects as $subjectName => $qualifications) {
                        foreach ($qualifications as $qualification => $minGrade) {
                            // Find or create the O-Level subject
                            $oLevelSubject = OLevelSubject::firstOrCreate([
                                'name' => $subjectName,
                                'qualification' => $qualification
                            ]);

                            // Create the requirement
                            ProgrammeOlevelRequirement::firstOrCreate(
                                [
                                    'school_programme_id' => $schoolProgramme->id,
                                    'o_level_subject_id' => $oLevelSubject->id,
                                ],
                                [
                                    'category' => $category,
                                    'min_grade' => $minGrade,
                                ]
                            );
                        }
                    }
                }
            }
        }
    }
}