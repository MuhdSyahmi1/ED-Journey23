<?php

namespace Database\Seeders;

use App\Models\DiplomaProgramme;
use Illuminate\Database\Seeder;

class DiplomaProgrammesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programmes = [
            ['name' => 'Diploma in Business Accounting & Finance', 'duration' => '2.5', 'school' => 'School of Business'],
            ['name' => 'Diploma in Entrepreneurship & Marketing Strategies', 'duration' => '2.5', 'school' => 'School of Business'],
            ['name' => 'Diploma in Human Capital Management', 'duration' => '2.5', 'school' => 'School of Business'],
            ['name' => 'Diploma in Business Studies', 'duration' => '2.5', 'school' => 'School of Business'],
            ['name' => 'Diploma in Data Analytics', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Web Technology / Web Development', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Applications Development', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Digital Arts & Media', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Information Systems', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Cloud & Networking', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Digital Media', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in IT Network', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Library Informatics Computing', 'duration' => '2.5', 'school' => 'School of ICT'],
            ['name' => 'Diploma in Health Science (Nursing)', 'duration' => '2.5', 'school' => 'School of Health Sciences'],
            ['name' => 'Diploma in Health Science (Midwifery)', 'duration' => '2.5', 'school' => 'School of Health Sciences'],
            ['name' => 'Diploma in Health Science (Paramedic)', 'duration' => '2.5', 'school' => 'School of Health Sciences'],
            ['name' => 'Diploma in Architecture', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Interior Design', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Civil Engineering', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Electrical Engineering / Electronic & Communication Engineering', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Mechanical Engineering', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Petroleum Engineering', 'duration' => '2.5', 'school' => 'School of Science & Engineering'],
            ['name' => 'Diploma in Applied Science Technology', 'duration' => '2.5', 'school' => 'School of Petrochemical'],
        ];

        // Insert all programmes, but skip if combination already exists
        foreach ($programmes as $programme) {
            DiplomaProgramme::firstOrCreate(
                [
                    'name' => $programme['name'],
                    'duration' => $programme['duration'],
                    'school' => $programme['school']
                ],
                $programme
            );
        }
    }
}