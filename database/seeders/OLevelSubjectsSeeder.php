<?php

namespace Database\Seeders;

use App\Models\OLevelSubject;
use Illuminate\Database\Seeder;

class OLevelSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Core subjects (usually required)
            ['name' => 'English Language', 'qualification' => 'GCE'],
            ['name' => 'English Language', 'qualification' => 'IGCSE'],
            ['name' => 'Mathematics', 'qualification' => 'GCE'],
            ['name' => 'Mathematics', 'qualification' => 'IGCSE'],
            
            // Sciences
            ['name' => 'Physics', 'qualification' => 'GCE'],
            ['name' => 'Physics', 'qualification' => 'IGCSE'],
            ['name' => 'Chemistry', 'qualification' => 'GCE'],
            ['name' => 'Chemistry', 'qualification' => 'IGCSE'],
            ['name' => 'Biology', 'qualification' => 'GCE'],
            ['name' => 'Biology', 'qualification' => 'IGCSE'],
            ['name' => 'Combined Science', 'qualification' => 'GCE'],
            ['name' => 'Combined Science', 'qualification' => 'IGCSE'],
            
            // Languages
            ['name' => 'Bahasa Malaysia', 'qualification' => 'GCE'],
            ['name' => 'Chinese Language', 'qualification' => 'GCE'],
            ['name' => 'Chinese Language', 'qualification' => 'IGCSE'],
            ['name' => 'Tamil Language', 'qualification' => 'GCE'],
            ['name' => 'French', 'qualification' => 'GCE'],
            ['name' => 'French', 'qualification' => 'IGCSE'],
            ['name' => 'Spanish', 'qualification' => 'IGCSE'],
            ['name' => 'German', 'qualification' => 'IGCSE'],
            
            // Humanities and Social Sciences
            ['name' => 'History', 'qualification' => 'GCE'],
            ['name' => 'History', 'qualification' => 'IGCSE'],
            ['name' => 'Geography', 'qualification' => 'GCE'],
            ['name' => 'Geography', 'qualification' => 'IGCSE'],
            ['name' => 'Economics', 'qualification' => 'GCE'],
            ['name' => 'Economics', 'qualification' => 'IGCSE'],
            ['name' => 'Sociology', 'qualification' => 'IGCSE'],
            ['name' => 'Global Perspectives', 'qualification' => 'IGCSE'],
            
            // Business and Commerce
            ['name' => 'Accounting', 'qualification' => 'GCE'],
            ['name' => 'Business Studies', 'qualification' => 'GCE'],
            ['name' => 'Business Studies', 'qualification' => 'IGCSE'],
            ['name' => 'Commerce', 'qualification' => 'GCE'],
            ['name' => 'Entrepreneurship', 'qualification' => 'GCE'],
            
            // Arts and Creative
            ['name' => 'Art and Design', 'qualification' => 'GCE'],
            ['name' => 'Art and Design', 'qualification' => 'IGCSE'],
            ['name' => 'Music', 'qualification' => 'GCE'],
            ['name' => 'Music', 'qualification' => 'IGCSE'],
            ['name' => 'Drama', 'qualification' => 'IGCSE'],
            ['name' => 'Literature in English', 'qualification' => 'GCE'],
            ['name' => 'Literature in English', 'qualification' => 'IGCSE'],
            
            // Technology and Computing
            ['name' => 'Computer Science', 'qualification' => 'GCE'],
            ['name' => 'Computer Science', 'qualification' => 'IGCSE'],
            ['name' => 'Information and Communication Technology', 'qualification' => 'GCE'],
            ['name' => 'Information and Communication Technology', 'qualification' => 'IGCSE'],
            ['name' => 'Design and Technology', 'qualification' => 'IGCSE'],
            
            // Physical Education and Health
            ['name' => 'Physical Education', 'qualification' => 'GCE'],
            ['name' => 'Physical Education', 'qualification' => 'IGCSE'],
            ['name' => 'Health Education', 'qualification' => 'GCE'],
            
            // Religious Studies
            ['name' => 'Islamic Religious Studies', 'qualification' => 'GCE'],
            ['name' => 'Moral Education', 'qualification' => 'GCE'],
            ['name' => 'Religious Studies', 'qualification' => 'IGCSE'],
            
            // Additional Mathematics and Sciences
            ['name' => 'Additional Mathematics', 'qualification' => 'GCE'],
            ['name' => 'Additional Mathematics', 'qualification' => 'IGCSE'],
            ['name' => 'Environmental Science', 'qualification' => 'IGCSE'],
            ['name' => 'Psychology', 'qualification' => 'IGCSE'],
            
            // Technical and Vocational
            ['name' => 'Engineering', 'qualification' => 'GCE'],
            ['name' => 'Food and Nutrition', 'qualification' => 'IGCSE'],
            ['name' => 'Travel and Tourism', 'qualification' => 'IGCSE'],
        ];

        // Insert all subjects, but skip if combination already exists
        foreach ($subjects as $subject) {
            OLevelSubject::firstOrCreate(
                [
                    'name' => $subject['name'],
                    'qualification' => $subject['qualification']
                ],
                $subject
            );
        }
    }
}