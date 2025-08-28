<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
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
            
            for ($i = 1; $i <= 10; $i++) {
                User::create([
                    'name' => "Profile User {$i}",
                    'email' => "profileuser{$i}@example.com",
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role' => 'user',
                    'status' => 'active',
                ]);
            }
            
            $users = User::where('role', 'user')->get();
        }

        // Sample user profile data
        $userProfiles = [
            [
                'name' => 'Ahmad Hasan bin Abdullah',
                'identity_card' => '12-345678',
                'id_color' => 'yellow',
                'postal_address' => 'No. 123, Jalan Keramat, Kampong Kiulap, BB3713, Brunei Darussalam',
                'date_of_birth' => '2005-03-15',
                'place_of_birth' => 'Bandar Seri Begawan',
                'gender' => 'male',
                'telephone_home' => '2234567',
                'mobile_phone' => '8901234',
                'email_address' => 'ahmad.hasan@email.com',
                'religion' => 'islam',
                'nationality' => 'Bruneian',
                'race' => 'malay',
                'health_record' => 'No major health issues. Wears glasses for reading.',
                'verification_status' => 'pending',
            ],
            [
                'name' => 'Siti Aminah binti Ibrahim',
                'identity_card' => '15-234567',
                'id_color' => 'yellow',
                'postal_address' => 'No. 456, Jalan Muara, Kampong Serasa, KB1131, Brunei Darussalam',
                'date_of_birth' => '2004-07-22',
                'place_of_birth' => 'Kuala Belait',
                'gender' => 'female',
                'telephone_home' => null,
                'mobile_phone' => '8765432',
                'email_address' => 'siti.aminah@email.com',
                'religion' => 'islam',
                'nationality' => 'Bruneian',
                'race' => 'malay',
                'health_record' => 'Mild asthma, uses inhaler when needed.',
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(5),
                'verified_by' => 1, // Assuming admin user ID 1
            ],
            [
                'name' => 'Chen Wei Ming',
                'identity_card' => '18-876543',
                'id_color' => 'green',
                'postal_address' => 'No. 789, Jalan Gadong, Kampong Gadong BE, BE3919, Brunei Darussalam',
                'date_of_birth' => '2005-11-08',
                'place_of_birth' => 'Bandar Seri Begawan',
                'gender' => 'male',
                'telephone_home' => '2345678',
                'mobile_phone' => '8123456',
                'email_address' => 'chen.weiming@email.com',
                'religion' => 'buddhism',
                'nationality' => 'Chinese',
                'race' => 'chinese',
                'health_record' => 'No known allergies or health issues.',
                'verification_status' => 'pending',
            ],
            [
                'name' => 'Raj Kumar Patel',
                'identity_card' => '20-654321',
                'id_color' => 'red',
                'postal_address' => 'No. 321, Jalan Tutong, Kampong Tungku, TA1341, Brunei Darussalam',
                'date_of_birth' => '2004-12-03',
                'place_of_birth' => 'Tutong',
                'gender' => 'male',
                'telephone_home' => '4567890',
                'mobile_phone' => '8987654',
                'email_address' => 'raj.patel@email.com',
                'religion' => 'hinduism',
                'nationality' => 'Indian',
                'race' => 'other',
                'health_record' => 'Vegetarian diet due to religious beliefs.',
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(12),
                'verified_by' => 1,
            ],
            [
                'name' => 'Sarah Jessica Thompson',
                'identity_card' => '16-432109',
                'id_color' => 'red',
                'postal_address' => 'No. 654, Jalan Seria, Kampong Seria, KB1110, Brunei Darussalam',
                'date_of_birth' => '2005-05-18',
                'place_of_birth' => 'Seria',
                'gender' => 'female',
                'telephone_home' => null,
                'mobile_phone' => '8456789',
                'email_address' => 'sarah.thompson@email.com',
                'religion' => 'christianity',
                'nationality' => 'American',
                'race' => 'other',
                'health_record' => 'Lactose intolerant. No other health concerns.',
                'verification_status' => 'pending',
            ],
            [
                'name' => 'Muhammad Farid bin Hassan',
                'identity_card' => '14-567890',
                'id_color' => 'yellow',
                'postal_address' => 'No. 987, Jalan Temburong, Kampong Bangar, PA1151, Brunei Darussalam',
                'date_of_birth' => '2004-09-25',
                'place_of_birth' => 'Bangar',
                'gender' => 'male',
                'telephone_home' => '5234567',
                'mobile_phone' => '8234567',
                'email_address' => 'farid.hassan@email.com',
                'religion' => 'islam',
                'nationality' => 'Bruneian',
                'race' => 'malay',
                'health_record' => 'Previous ankle injury from sports, fully recovered.',
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(8),
                'verified_by' => 1,
            ],
            [
                'name' => 'Li Mei Hua',
                'identity_card' => '17-321654',
                'id_color' => 'green',
                'postal_address' => 'No. 147, Jalan Berakas, Kampong Berakas A, BB2713, Brunei Darussalam',
                'date_of_birth' => '2005-01-12',
                'place_of_birth' => 'Bandar Seri Begawan',
                'gender' => 'female',
                'telephone_home' => '2678901',
                'mobile_phone' => '8345678',
                'email_address' => 'li.meihua@email.com',
                'religion' => 'other',
                'nationality' => 'Chinese',
                'race' => 'chinese',
                'health_record' => 'Regular checkups show good health.',
                'verification_status' => 'rejected',
                'verified_at' => now()->subDays(7),
                'verified_by' => 1,
            ],
            [
                'name' => 'David Michael Johnson',
                'identity_card' => '19-789012',
                'id_color' => 'red',
                'postal_address' => 'No. 258, Jalan Lambak, Kampong Lambak Kanan, BG1220, Brunei Darussalam',
                'date_of_birth' => '2004-04-30',
                'place_of_birth' => 'Bandar Seri Begawan',
                'gender' => 'male',
                'telephone_home' => null,
                'mobile_phone' => '8567890',
                'email_address' => 'david.johnson@email.com',
                'religion' => 'christianity',
                'nationality' => 'British',
                'race' => 'other',
                'health_record' => 'High cholesterol, on medication.',
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(3),
                'verified_by' => 1,
            ],
            [
                'name' => 'Nurul Izzah binti Mohd Yusof',
                'identity_card' => '13-456789',
                'id_color' => 'yellow',
                'postal_address' => 'No. 369, Jalan Lumapas, Kampong Lumapas, BF1320, Brunei Darussalam',
                'date_of_birth' => '2005-08-14',
                'place_of_birth' => 'Bandar Seri Begawan',
                'gender' => 'female',
                'telephone_home' => '2789012',
                'mobile_phone' => '8678901',
                'email_address' => 'nurul.izzah@email.com',
                'religion' => 'islam',
                'nationality' => 'Bruneian',
                'race' => 'malay',
                'health_record' => 'Excellent health record with regular exercise.',
                'verification_status' => 'rejected',
                'verified_at' => now()->subDays(2),
                'verified_by' => 1,
            ],
            [
                'name' => 'Krishna Sharma',
                'identity_card' => '21-098765',
                'id_color' => 'red',
                'postal_address' => 'No. 741, Jalan Panaga, Kampong Panaga, KB1033, Brunei Darussalam',
                'date_of_birth' => '2004-10-07',
                'place_of_birth' => 'Seria',
                'gender' => 'male',
                'telephone_home' => '3234567',
                'mobile_phone' => '8789012',
                'email_address' => 'krishna.sharma@email.com',
                'religion' => 'hinduism',
                'nationality' => 'Indian',
                'race' => 'other',
                'health_record' => 'Diabetes type 1, manages with insulin.',
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(15),
                'verified_by' => 1,
            ],
        ];

        // Create user profiles
        foreach ($userProfiles as $index => $profileData) {
            // Assign to user, cycling through available users
            $user = $users[$index % $users->count()];
            
            // Check if user already has a profile
            if (DB::table('user_profiles')->where('user_id', $user->id)->exists()) {
                continue; // Skip if profile already exists
            }
            
            DB::table('user_profiles')->insert([
                'user_id' => $user->id,
                'ic_file_path' => null, // No actual files for seeded data
                'ic_file_name' => null,
                'name' => $profileData['name'],
                'identity_card' => $profileData['identity_card'],
                'id_color' => $profileData['id_color'],
                'postal_address' => $profileData['postal_address'],
                'date_of_birth' => $profileData['date_of_birth'],
                'place_of_birth' => $profileData['place_of_birth'],
                'gender' => $profileData['gender'],
                'telephone_home' => $profileData['telephone_home'],
                'mobile_phone' => $profileData['mobile_phone'],
                'email_address' => $profileData['email_address'],
                'religion' => $profileData['religion'],
                'nationality' => $profileData['nationality'],
                'race' => $profileData['race'],
                'health_record' => $profileData['health_record'],
                'verification_status' => $profileData['verification_status'],
                'verified_at' => $profileData['verified_at'] ?? null,
                'verified_by' => $profileData['verified_by'] ?? null,
                'created_at' => now()->subDays(rand(1, 30)), // Random dates within last 30 days
                'updated_at' => now()->subDays(rand(0, 15)), // Updated sometime after creation
            ]);
        }

        $this->command->info('Created 10 user profiles successfully!');
        $this->command->info('Profile distribution: 5 pending verification, 5 verified');
        $this->command->info('Users assigned: ' . $users->pluck('name')->join(', '));
    }
}