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
        // Check if case reports already exist
        if (CaseReport::count() > 0) {
            $this->command->info('Case reports already exist. Skipping seeding to prevent duplicates.');
            $this->command->info('Current case report count: ' . CaseReport::count());
            $this->command->info('If you want to re-seed, please clear existing case reports first:');
            $this->command->info('Run: php artisan tinker');
            $this->command->info('Then: App\\Models\\CaseReport::truncate();');
            return;
        }

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

        // Sample case report data with all three case types
        $caseReports = [
            // Incorrect Data examples
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
            
            // Missing Subject examples
            [
                'subject' => 'Economics',
                'subject_type' => 'O-Level',
                'case_type' => 'Missing Subject',
                'description' => 'My Economics O-Level result is completely missing from the scanned results. I have this subject on my certificate but it was not detected.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Geography',
                'subject_type' => 'A-Level',
                'case_type' => 'Missing Subject',
                'description' => 'Geography A-Level is missing from my results. The scanner failed to detect this subject entirely despite it being clearly printed on my certificate.',
                'status' => 'in progress',
            ],
            [
                'subject' => 'Art and Design',
                'subject_type' => 'O-Level',
                'case_type' => 'Missing Subject',
                'description' => 'Art and Design subject is not showing up in my O-Level results. This subject should be there with a grade of B+.',
                'status' => 'solved',
            ],
            [
                'subject' => 'Electrical Engineering',
                'subject_type' => 'Hntec',
                'case_type' => 'Missing Subject',
                'description' => 'My HnTEC Electrical Engineering programme is completely missing from the scan. I completed this with a Merit grade.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Business Studies',
                'subject_type' => 'A-Level',
                'case_type' => 'Missing Subject',
                'description' => 'Business Studies A-Level subject was not detected by the scanning system. This is a required subject for my university application.',
                'status' => 'in progress',
            ],
            
            // Incorrect Data & Missing Subject examples
            [
                'subject' => 'Biology',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data & Missing Subject',
                'description' => 'Biology grade scanned incorrectly as E instead of B, and my Additional Mathematics subject is completely missing from the results.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Computer Science',
                'subject_type' => 'A-Level',
                'case_type' => 'Incorrect Data & Missing Subject',
                'description' => 'Computer Science shows wrong grade (C instead of A) and my Further Mathematics A-Level subject is missing entirely.',
                'status' => 'in progress',
            ],
            [
                'subject' => 'Mechanical Engineering',
                'subject_type' => 'Hntec',
                'case_type' => 'Incorrect Data & Missing Subject',
                'description' => 'HnTEC Mechanical Engineering shows Pass instead of Merit, and my Civil Engineering programme is missing from the scan.',
                'status' => 'solved',
            ],
            [
                'subject' => 'History',
                'subject_type' => 'O-Level',
                'case_type' => 'Incorrect Data & Missing Subject',
                'description' => 'History grade incorrectly scanned as E when it should be B, and my Islamic Religious Knowledge subject is not detected at all.',
                'status' => 'pending',
            ],
            [
                'subject' => 'Accounting',
                'subject_type' => 'A-Level',
                'case_type' => 'Incorrect Data & Missing Subject',
                'description' => 'Accounting A-Level shows wrong grade (D instead of A-) and my Economics A-Level subject is completely missing from the results.',
                'status' => 'in progress',
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

        $this->command->info('Created 15 case reports successfully!');
        $this->command->info('Case reports created for users: ' . $users->pluck('name')->join(', '));
    }
}