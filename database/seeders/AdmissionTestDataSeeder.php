<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\CaseReport;
use App\Models\StudentApplication;
use App\Models\StudentAppeal;
use App\Models\SchoolProgramme;
use App\Models\StudentGrade;
use App\Models\OcrResult;
use Carbon\Carbon;

class AdmissionTestDataSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Create 10 test users with Gmail accounts
        $testUsers = [
            ['name' => 'Alice Chen', 'email' => 'alice.chen.test@gmail.com'],
            ['name' => 'Bob Rahman', 'email' => 'bob.rahman.test@gmail.com'],
            ['name' => 'Catherine Wong', 'email' => 'catherine.wong.test@gmail.com'],
            ['name' => 'David Kumar', 'email' => 'david.kumar.test@gmail.com'],
            ['name' => 'Emily Tan', 'email' => 'emily.tan.test@gmail.com'],
            ['name' => 'Farid Aziz', 'email' => 'farid.aziz.test@gmail.com'],
            ['name' => 'Grace Liu', 'email' => 'grace.liu.test@gmail.com'],
            ['name' => 'Hassan Osman', 'email' => 'hassan.osman.test@gmail.com'],
            ['name' => 'Irene Lim', 'email' => 'irene.lim.test@gmail.com'],
            ['name' => 'Jason Ng', 'email' => 'jason.ng.test@gmail.com'],
        ];

        $createdUsers = [];

        foreach ($testUsers as $userData) {
            // Check if user already exists
            $user = User::where('email', $userData['email'])->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => bcrypt('password'),
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);
            }
            
            $createdUsers[] = $user;
        }

        // Create user profiles for each user
        foreach ($createdUsers as $index => $user) {
            // Check if profile already exists
            if (!$user->userProfile) {
                UserProfile::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'identity_card' => 'IC' . str_pad(900000 + $index, 6, '0', STR_PAD_LEFT),
                    'id_color' => ['yellow', 'red', 'green'][rand(0, 2)],
                    'postal_address' => ['123 Main St, KL', '456 Oak Ave, Selangor', '789 Pine Rd, Penang'][rand(0, 2)],
                    'date_of_birth' => Carbon::now()->subYears(rand(18, 25))->format('Y-m-d'),
                    'place_of_birth' => ['Kuala Lumpur', 'Selangor', 'Penang', 'Johor'][rand(0, 3)],
                    'gender' => ['male', 'female'][rand(0, 1)],
                    'telephone_home' => '03-' . rand(10000000, 99999999),
                    'mobile_phone' => '01' . rand(10000000, 99999999),
                    'email_address' => $user->email,
                    'religion' => ['islam', 'christianity', 'buddhism', 'hinduism'][rand(0, 3)],
                    'nationality' => 'Malaysian',
                    'race' => ['malay', 'chinese', 'indian', 'other'][rand(0, 3)],
                    'health_record' => 'Good',
                    'verification_status' => $index < 7 ? 'verified' : 'pending', // First 7 users verified
                    'hecas_id' => 'HECAS' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                ]);
            }
        }

        // Get available programmes
        $programmes = SchoolProgramme::where('is_active', true)->get();
        if ($programmes->isEmpty()) {
            $this->command->info('No active programmes found. Please run programme seeders first.');
            return;
        }

        // Create case reports (3 users with case reports)
        $caseReportUsers = collect($createdUsers)->slice(0, 3);
        $caseReportTypes = ['Grade Discrepancy', 'Document Issues', 'Medical Issues'];
        $caseReportStatuses = ['pending', 'in progress', 'solved'];

        foreach ($caseReportUsers as $index => $user) {
            // Check if case report already exists
            if (!CaseReport::where('user_id', $user->id)->exists()) {
                CaseReport::create([
                    'user_id' => $user->id,
                    'subject' => $caseReportTypes[$index],
                    'subject_type' => ['O-Level', 'A-Level', 'Hntec'][rand(0, 2)],
                    'case_type' => 'Incorrect Data',
                    'description' => $this->getCaseDescription($caseReportTypes[$index]),
                    'status' => $caseReportStatuses[$index],
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        // Create O-Level grade data for users
        $oLevelSubjects = ['English Language', 'Mathematics', 'Science', 'Malay Language', 'History'];
        $grades = ['A', 'B', 'C', 'D', 'E'];

        foreach ($createdUsers as $user) {
            // Only create grades for verified users to ensure they can have applications
            if ($user->userProfile && $user->userProfile->verification_status === 'verified') {
                // Create OCR result first
                $ocrResult = OcrResult::firstOrCreate([
                    'user_id' => $user->id,
                    'ocr_type' => 'o_level',
                ], [
                    'filename' => 'olevel_results_' . $user->id . '.jpg',
                    'text' => 'O Level Results for ' . $user->name,
                    'created_at' => now()->subDays(rand(30, 60)),
                ]);

                // Create student grades
                foreach ($oLevelSubjects as $subject) {
                    if (!StudentGrade::where('user_id', $user->id)->where('subject', $subject)->exists()) {
                        $grade = $grades[rand(0, 4)];
                        StudentGrade::create([
                            'user_id' => $user->id,
                            'ocr_result_id' => $ocrResult->id,
                            'subject' => $subject,
                            'grade' => $grade,
                            'syllabus' => '1123',
                            'context_line' => "Subject: {$subject} Grade: {$grade} Syllabus: 1123",
                            'confidence' => rand(85, 99) / 100, // Random confidence between 0.85 and 0.99
                        ]);
                    }
                }
            }
        }

        // Reload users with their profiles to get fresh data
        $userIds = collect($createdUsers)->pluck('id');
        $verifiedUsers = User::whereIn('id', $userIds)
            ->with('userProfile')
            ->get()
            ->filter(function($user) {
                return $user->userProfile && $user->userProfile->verification_status === 'verified';
            });

        $applicationStatuses = ['pending', 'pending', 'accepted', 'rejected', 'rejected', 'waitlisted']; // More variety
        $applicationCount = 0;

        foreach ($verifiedUsers as $user) {
            if ($applicationCount >= 10) break; // Increase to 10 applications

            // Each user applies to 1-2 programmes
            $userProgrammes = $programmes->shuffle()->take(rand(1, 2));
            
            foreach ($userProgrammes as $index => $programme) {
                // Check if application already exists for this user and programme
                if (!StudentApplication::where('user_id', $user->id)
                    ->where('school_programme_id', $programme->id)->exists()) {
                    
                    // Also check if user already has an application with this preference rank
                    $preferenceRank = $index + 1;
                    if (!StudentApplication::where('user_id', $user->id)
                        ->where('preference_rank', $preferenceRank)->exists()) {
                        
                        $status = $applicationStatuses[array_rand($applicationStatuses)];
                        
                        StudentApplication::create([
                            'user_id' => $user->id,
                            'school_programme_id' => $programme->id,
                            'preference_rank' => $preferenceRank,
                            'status' => $status,
                            'applied_at' => now()->subDays(rand(5, 45)),
                            'review_notes' => $status !== 'pending' ? $this->getReviewNote($status) : null,
                            'reviewed_at' => $status !== 'pending' ? now()->subDays(rand(1, 10)) : null,
                            'reviewed_by' => $status !== 'pending' ? 1 : null, // Assuming admin user ID 1
                        ]);
                    }
                }
            }
            $applicationCount++;
        }

        // Skip creating student appeals - leave empty for manual creation

        // Count what we actually created
        $actualApplications = StudentApplication::whereIn('user_id', $userIds)->count();
        $actualVerifiedUsers = $verifiedUsers->count();
        
        $this->command->info('✅ Admission test data seeded successfully!');
        $this->command->info("📊 Created data for:");
        $this->command->info("   • " . count($createdUsers) . " test users");
        $this->command->info("   • " . $actualVerifiedUsers . " verified users");
        $this->command->info("   • " . $caseReportUsers->count() . " case reports");
        $this->command->info("   • " . $actualApplications . " student applications");
        $this->command->info("   • 0 student appeals (skipped for manual creation)");
    }

    private function getCaseDescription($type): string
    {
        $descriptions = [
            'Grade Discrepancy' => 'There is a discrepancy between the OCR-extracted grades and the original document. The Mathematics grade shows as C but should be B according to the certificate.',
            'Document Issues' => 'The uploaded document quality is poor and some grades cannot be properly extracted. Student needs to resubmit clearer documents.',
            'Medical Issues' => 'Student has provided medical documentation regarding examination conditions that may have affected their results. Requires review for special consideration.',
        ];

        return $descriptions[$type] ?? 'General issue requiring attention.';
    }

    private function getReviewNote($status): string
    {
        $notes = [
            'accepted' => 'Student meets all programme requirements with good academic standing. Accepted for admission.',
            'rejected' => 'Student does not meet minimum grade requirements for this programme. Consider alternative programmes.',
            'waitlisted' => 'Student meets requirements but programme is at capacity. Placed on waiting list.',
        ];

        return $notes[$status] ?? '';
    }

    private function getAppealReason($programmeName): string
    {
        $reasons = [
            "I believe my application for $programmeName was rejected due to a misunderstanding regarding my Mathematics grade. The OCR system may have incorrectly read my grade as D when it is actually C. I have attached a clearer scan of my certificate for verification.",
            
            "I am appealing the rejection decision for $programmeName based on extenuating circumstances during my O-Level examinations. I was hospitalized for a week before my Mathematics exam due to dengue fever, which significantly impacted my performance. I have attached medical documentation to support this appeal.",
            
            "I would like to appeal the rejection for $programmeName as I believe there was an error in the evaluation process. My overall academic performance shows consistent good grades, and I have additional qualifications that were not considered in the initial review."
        ];

        return $reasons[array_rand($reasons)];
    }

    private function getAppealResponse($status): string
    {
        $responses = [
            'approved' => 'After reviewing your appeal and supporting documentation, we have decided to approve your application. The grade discrepancy has been verified and your application status has been updated to accepted.',
            'rejected' => 'We have carefully reviewed your appeal submission. While we understand the circumstances, the academic requirements for this programme must be maintained. We encourage you to consider alternative programmes that may be suitable for your qualifications.',
        ];

        return $responses[$status] ?? '';
    }
}