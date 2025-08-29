<?php

namespace Database\Seeders;

use App\Models\ALevelSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ALevelSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Sciences
            ['name' => 'Biology', 'qualification' => 'Advanced Level'],
            ['name' => 'Biology', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Chemistry', 'qualification' => 'Advanced Level'],
            ['name' => 'Chemistry', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Physics', 'qualification' => 'Advanced Level'],
            ['name' => 'Physics', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Mathematics', 'qualification' => 'Advanced Level'],
            ['name' => 'Mathematics', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Further Mathematics', 'qualification' => 'Advanced Level'],
            ['name' => 'Further Mathematics', 'qualification' => 'Advanced Subsidiary'],
            
            // Languages & Literature
            ['name' => 'English Language', 'qualification' => 'Advanced Level'],
            ['name' => 'English Language', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'English Literature', 'qualification' => 'Advanced Level'],
            ['name' => 'English Literature', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Malay Language', 'qualification' => 'Advanced Level'],
            ['name' => 'Malay Language', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Chinese Language', 'qualification' => 'Advanced Level'],
            ['name' => 'Chinese Language', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'French', 'qualification' => 'Advanced Level'],
            ['name' => 'French', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'German', 'qualification' => 'Advanced Level'],
            ['name' => 'German', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Spanish', 'qualification' => 'Advanced Level'],
            ['name' => 'Spanish', 'qualification' => 'Advanced Subsidiary'],
            
            // Humanities
            ['name' => 'History', 'qualification' => 'Advanced Level'],
            ['name' => 'History', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Geography', 'qualification' => 'Advanced Level'],
            ['name' => 'Geography', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Economics', 'qualification' => 'Advanced Level'],
            ['name' => 'Economics', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Sociology', 'qualification' => 'Advanced Level'],
            ['name' => 'Sociology', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Psychology', 'qualification' => 'Advanced Level'],
            ['name' => 'Psychology', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Philosophy', 'qualification' => 'Advanced Level'],
            ['name' => 'Philosophy', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Religious Studies', 'qualification' => 'Advanced Level'],
            ['name' => 'Religious Studies', 'qualification' => 'Advanced Subsidiary'],
            
            // Arts & Design
            ['name' => 'Art & Design', 'qualification' => 'Advanced Level'],
            ['name' => 'Art & Design', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Music', 'qualification' => 'Advanced Level'],
            ['name' => 'Music', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Drama & Theatre Studies', 'qualification' => 'Advanced Level'],
            ['name' => 'Drama & Theatre Studies', 'qualification' => 'Advanced Subsidiary'],
            
            // Business & Commerce
            ['name' => 'Business Studies', 'qualification' => 'Advanced Level'],
            ['name' => 'Business Studies', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Accounting', 'qualification' => 'Advanced Level'],
            ['name' => 'Accounting', 'qualification' => 'Advanced Subsidiary'],
            
            // Technology & Computing
            ['name' => 'Computer Science', 'qualification' => 'Advanced Level'],
            ['name' => 'Computer Science', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Information Technology', 'qualification' => 'Advanced Level'],
            ['name' => 'Information Technology', 'qualification' => 'Advanced Subsidiary'],
            
            // Other Sciences
            ['name' => 'Environmental Science', 'qualification' => 'Advanced Level'],
            ['name' => 'Environmental Science', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Geology', 'qualification' => 'Advanced Level'],
            ['name' => 'Geology', 'qualification' => 'Advanced Subsidiary'],
            
            // Social Sciences
            ['name' => 'Government & Politics', 'qualification' => 'Advanced Level'],
            ['name' => 'Government & Politics', 'qualification' => 'Advanced Subsidiary'],
            ['name' => 'Law', 'qualification' => 'Advanced Level'],
            ['name' => 'Law', 'qualification' => 'Advanced Subsidiary'],
            
            // Physical Education & Health
            ['name' => 'Physical Education', 'qualification' => 'Advanced Level'],
            ['name' => 'Physical Education', 'qualification' => 'Advanced Subsidiary'],
        ];

        foreach ($subjects as $subject) {
            ALevelSubject::firstOrCreate(
                ['name' => $subject['name'], 'qualification' => $subject['qualification']],
                $subject
            );
        }
    }
}
