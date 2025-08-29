<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First run your existing admin seeder
        $this->call([
            AdminUserSeeder::class,
            StaffSeeder::class,
        ]);

        // Create your existing test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
        ]);

        // Then run the feedback seeder (which builds on the admin and test user)
        $this->call([
            FeedbackSeeder::class,
            CaseReportSeeder::class,
            UserProfileSeeder::class,
            OLevelSubjectsSeeder::class,
        ]);
    }
}