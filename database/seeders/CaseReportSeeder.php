<?php

namespace Database\Seeders;

use App\Models\CaseReport;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaseReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all regular users (not admin/staff)
        $users = User::where('role', 'user')->get();

        // If no users exist, create some test users first
        if ($users->isEmpty()) {
            $this->command->info('No users found. Creating test users first...');
            
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => "Test User {$i}",
                    'email' => "user{$i}@example.com",
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role' => 'user',
                    'status' => 'active',
                ]);
            }
            
            $users = User::where('role', 'user')->get();
        }

        // Sample case report data
        $caseReports = [
            [
                'subject' => 'Mathematics',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'My mathematics grade was scanned as C when it should be B. The OCR system misread the grade on my certificate.',
                'status' => 'pending',
            ],
            [
                'subject' => 'English Language',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'The grade for English Language shows as D but my actual grade is A. Please verify and correct this error.',
                'status' => 'in progress',
            ],
            [
                'subject' => 'Physics',
                'subject_type' => 'A-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'Physics A-Level grade was not detected at all by the scanning system. My grade is B+ but it shows as blank.',
                'status' => 'solved',
            ],
            [
                'subject' => 'Biology',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'Biology grade scanned incorrectly. The system read B as E due to poor image quality during scanning.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Chemistry',
                'subject_type' => 'A-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'My Chemistry A-Level result shows as F when my actual grade is A-. This is a significant error that needs immediate attention.',
                'status' => 'in progress',
            ],
            [
                'subject' => 'Information Technology',
                'subject_type' => 'Hntec',
                'case_type' => 'Incorrect Data',
                'description' => 'The HnTEC Information Technology grade was completely missed by the scanner. I achieved a Distinction but it\'s not showing up.',
                'status' => 'solved',
            ],
            [
                'subject' => 'Business Studies',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'Business Studies grade shows C+ instead of A-. The scanning seems to have difficulty with the plus/minus symbols.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Computer Science',
                'subject_type' => 'A-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'Computer Science A-Level grade scanned as C when my certificate clearly shows A. Need this corrected for university applications.',
                'status' => 'in progress',
            ],
            [
                'subject' => 'Mechanical Engineering',
                'subject_type' => 'Hntec',
                'case_type' => 'Incorrect Data',
                'description' => 'HnTEC Mechanical Engineering result not recognized. I have a Merit grade but the system shows no result.',
                'status' => 'solved',
            ],
            [
                'subject' => 'History',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data',
                'description' => 'History grade incorrectly scanned as E when my actual grade is B. This affects my overall GPA calculation.',
                'status' => 'pending',
            ],
        ];

        // Create case reports
        foreach ($caseReports as $index => $caseData) {
            // Assign to random user, cycling through available users
            $user = $users[$index % $users->count()];
            
            CaseReport::create([
                'user_id' => $user->id,
                'subject' => $caseData['subject'],
                'subject_type' => $caseData['subject_type'],
                'case_type' => $caseData['case_type'],
                'description' => $caseData['description'],
                'status' => $caseData['status'],
                'created_at' => now()->subDays(rand(1, 30)), // Random dates within last 30 days
                'updated_at' => now()->subDays(rand(0, 15)), // Updated sometime after creation
            ]);
        }

        $this->command->info('Created 10 case reports successfully!');
        $this->command->info('Case reports created for users: ' . $users->pluck('name')->join(', '));
    }
}