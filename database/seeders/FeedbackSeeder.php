<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some test users if they don't exist (building on your existing structure)
        $users = [];
        
        // First, get your existing test user
        $existingTestUser = User::where('email', 'test@example.com')->first();
        if ($existingTestUser) {
            $users[] = $existingTestUser;
        }
        
        // Create additional users for more diverse feedback
        $additionalUsers = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com'],
            ['name' => 'Sarah Johnson', 'email' => 'sarah.johnson@example.com'],
            ['name' => 'Michael Chen', 'email' => 'michael.chen@example.com'],
            ['name' => 'Emma Wilson', 'email' => 'emma.wilson@example.com'],
            ['name' => 'David Rodriguez', 'email' => 'david.rodriguez@example.com'],
            ['name' => 'Lisa Anderson', 'email' => 'lisa.anderson@example.com'],
            ['name' => 'James Thompson', 'email' => 'james.thompson@example.com'],
            ['name' => 'Maria Garcia', 'email' => 'maria.garcia@example.com'],
            ['name' => 'Robert Kim', 'email' => 'robert.kim@example.com'],
        ];

        foreach ($additionalUsers as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
            $users[] = $user;
        }

        // Get your existing admin user for replies
        $admin = User::where('email', 'admin@example.com')->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found! Please run AdminUserSeeder first.');
            return;
        }

        // Realistic feedback data with new feedback types
        $feedbackData = [
            // Recent feedback (last few days)
            [
                'subject' => 'System Performance Issues',
                'message' => 'The website is quiet impressive! However, I noticed some loading issues on the course selection page. It takes about 5-6 seconds to load completely. Could this be optimized?',
                'feedback_type' => 'usability_feedback', // This will auto-set priority to 'low'
                'status' => 'pending',
                'days_ago' => 1,
            ],
            [
                'subject' => 'Login Authentication Bug',
                'message' => 'I cannot access my account. Every time I try to log in, it says "Invalid credentials" even though I am sure my password is correct. Please help!',
                'feedback_type' => 'technical_issue', // This will auto-set priority to 'high'
                'status' => 'in-progress',
                'days_ago' => 2,
                'admin_reply' => 'Hi! I understand your frustration with the login issue. We have identified a temporary bug affecting some user accounts. Our development team is working on a fix. In the meantime, please try using the "Forgot Password" feature to reset your password. This should resolve the immediate issue.',
            ],
            [
                'subject' => 'Course Content Feedback',
                'message' => 'The JavaScript fundamentals course is excellent! The explanations are clear and the examples are very practical. However, I would love to see more advanced topics covered in future modules.',
                'feedback_type' => 'course_feedback', // This will auto-set priority to 'medium'
                'status' => 'solved',
                'days_ago' => 3,
                'admin_reply' => 'Thank you so much for your positive feedback! We are thrilled to hear that you found the JavaScript course helpful. Your suggestion about advanced topics has been forwarded to our curriculum team. We are planning to release advanced JavaScript modules including ES6+, async programming, and frameworks in the next quarter.',
            ],
            [
                'subject' => 'Payment Processing Error',
                'message' => 'I tried to enroll in the premium course package but the payment failed three times. My bank confirmed there are no issues on their end. This is urgent as the discount expires tomorrow.',
                'feedback_type' => 'account_billing', // This will auto-set priority to 'high'
                'status' => 'solved',
                'days_ago' => 4,
                'admin_reply' => 'I apologize for the payment processing issue. This was caused by a temporary gateway problem that has now been resolved. I have manually applied the discount to your account and sent you a direct payment link. You should receive an email within the next few minutes.',
            ],
            [
                'subject' => 'Mobile App Feature Request',
                'message' => 'Your platform is great on desktop, but have you considered developing a mobile app? It would be so convenient to continue learning during commutes.',
                'feedback_type' => 'feature_request', // This will auto-set priority to 'low'
                'status' => 'pending',
                'days_ago' => 5,
            ],
            
            // Week old feedback
            [
                'subject' => 'Certificate Download Issue',
                'message' => 'I completed the Python basics course last week but I still cannot download my certificate. The download button appears to be broken.',
                'feedback_type' => 'technical_issue', // This will auto-set priority to 'high'
                'status' => 'in-progress',
                'days_ago' => 8,
                'admin_reply' => 'Thank you for bringing this to our attention. We are currently updating our certificate generation system. Your certificate is ready and I will email it to you directly within the next 24 hours.',
            ],
            [
                'subject' => 'Video Audio Sync Error',
                'message' => 'Some of the video lectures in the web development course seem to have audio sync issues. This makes it difficult to follow along with the coding demonstrations.',
                'feedback_type' => 'content_error', // This will auto-set priority to 'medium'
                'status' => 'solved',
                'days_ago' => 10,
                'admin_reply' => 'We have identified and fixed the audio sync issues in the web development course videos. All affected lectures have been re-encoded and uploaded. Thank you for your patience and for reporting this issue.',
            ],
            [
                'subject' => 'Dark Mode Feature Request',
                'message' => 'I love studying late at night and would really appreciate a dark mode option for the learning platform. The current bright interface can be straining on the eyes.',
                'feedback_type' => 'feature_request', // This will auto-set priority to 'low'
                'status' => 'solved',
                'days_ago' => 12,
                'admin_reply' => 'Great news! We have implemented dark mode across the entire platform. You can toggle it by clicking the theme switcher in the top right corner of your dashboard. Thank you for the suggestion!',
            ],
            
            // Older feedback
            [
                'subject' => 'Course Progress Bug',
                'message' => 'My progress in the data science course keeps resetting. Every time I log back in, it shows I am at 0% completion even though I have watched several lectures.',
                'feedback_type' => 'technical_issue', // This will auto-set priority to 'high'
                'status' => 'solved',
                'days_ago' => 15,
                'admin_reply' => 'This was caused by a session management bug that has been fixed. I have manually restored your progress to the correct point (Module 4, Lesson 2). Going forward, your progress should save properly.',
            ],
            [
                'subject' => 'Instructor Response Time Concerns',
                'message' => 'The course instructor takes too long to respond to questions in the forum. I have been waiting for 4 days for a response to my technical question.',
                'feedback_type' => 'course_feedback', // This will auto-set priority to 'medium'
                'status' => 'solved',
                'days_ago' => 18,
                'admin_reply' => 'I apologize for the delayed response from the instructor. We have implemented a new policy requiring instructor responses within 48 hours. I have also personally addressed your technical question and the instructor will be more responsive going forward.',
            ],
            [
                'subject' => 'Quiz System Bug',
                'message' => 'The quiz at the end of Chapter 3 in the marketing course has a bug. Question 7 has two correct answers marked, but it only accepts one of them.',
                'feedback_type' => 'technical_issue', // This will auto-set priority to 'high'
                'status' => 'pending',
                'days_ago' => 20,
            ],
            [
                'subject' => 'Account Deletion Request',
                'message' => 'I would like to delete my account as I am no longer using the platform. Please let me know what steps I need to take.',
                'feedback_type' => 'account_billing', // This will auto-set priority to 'high'
                'status' => 'in-progress',
                'days_ago' => 22,
                'admin_reply' => 'I will process your account deletion request. Please note that this action is irreversible and will remove all your progress and certificates. If you are sure, please reply to confirm and I will delete your account within 7 days.',
            ],
            [
                'subject' => 'Duplicate Billing Charge',
                'message' => 'I was charged twice for my monthly subscription. Can you please check my billing history and issue a refund for the duplicate charge?',
                'feedback_type' => 'account_billing', // This will auto-set priority to 'high'
                'status' => 'solved',
                'days_ago' => 25,
                'admin_reply' => 'I have reviewed your billing history and confirmed the duplicate charge. A full refund for the extra charge has been processed and should appear in your account within 3-5 business days. I apologize for the inconvenience.',
            ],
            [
                'subject' => 'Course Path Recommendations',
                'message' => 'I completed the beginner web development course. What would you recommend as the next step? I am interested in both frontend and backend development.',
                'feedback_type' => 'general_feedback', // This will auto-set priority to 'low'
                'status' => 'solved',
                'days_ago' => 28,
                'admin_reply' => 'Congratulations on completing the beginner course! Based on your interests, I recommend our "Advanced Frontend with React" course and "Backend Development with Node.js". You could also consider our full-stack development track which combines both paths.',
            ],
            [
                'subject' => 'Group Study Feature Suggestion',
                'message' => 'It would be amazing if you could add a feature for students to form study groups and collaborate on projects. This would enhance the learning experience significantly.',
                'feedback_type' => 'feature_request', // This will auto-set priority to 'low'
                'status' => 'pending',
                'days_ago' => 30,
            ],
        ];

        // Create feedback entries
        foreach ($feedbackData as $index => $data) {
            $user = $users[$index % count($users)];
            $createdAt = now()->subDays($data['days_ago']);
            
            $feedback = Feedback::create([
                'user_id' => $user->id,
                'subject' => $data['subject'],
                'message' => $data['message'],
                'feedback_type' => $data['feedback_type'],
                'status' => $data['status'],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Add admin reply if provided
            if (isset($data['admin_reply'])) {
                $repliedAt = $createdAt->addHours(rand(2, 24));
                $feedback->update([
                    'admin_reply' => $data['admin_reply'],
                    'replied_by' => $admin->id,
                    'replied_at' => $repliedAt,
                    'resolved_at' => $data['status'] === 'solved' ? $repliedAt->addMinutes(rand(10, 120)) : null,
                ]);
            }
        }

        $this->command->info('Feedback seeder completed successfully!');
        $this->command->info('Created ' . count($feedbackData) . ' feedback entries with realistic data.');
        $this->command->info('Created ' . count($users) . ' test users (including existing).');
    }
}