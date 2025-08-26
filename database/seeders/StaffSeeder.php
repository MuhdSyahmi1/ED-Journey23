<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 16 staff/managers with different roles and specializations
        $staff = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'program',
                'status' => 'active',
            ],
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad.rahman@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'admission',
                'status' => 'active',
            ],
            [
                'name' => 'Emily Chen',
                'email' => 'emily.chen@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'news_events',
                'status' => 'active',
            ],
            [
                'name' => 'Muhammad Iqbal',
                'email' => 'muhammad.iqbal@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'program',
                'status' => 'active',
            ],
            [
                'name' => 'Dr. Lisa Wong',
                'email' => 'lisa.wong@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'data_analytics',
                'status' => 'active',
            ],
            [
                'name' => 'Alex Martinez',
                'email' => 'alex.martinez@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'moderators',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'news_events',
                'status' => 'active',
            ],
            [
                'name' => 'David Thompson',
                'email' => 'david.thompson@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'data_analytics',
                'status' => 'active',
            ],
            [
                'name' => 'Farah Abdullah',
                'email' => 'farah.abdullah@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'admission',
                'status' => 'active',
            ],
            [
                'name' => 'Marcus Lee',
                'email' => 'marcus.lee@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'moderators',
                'status' => 'active',
            ],
            [
                'name' => 'Dr. Aminah Hassan',
                'email' => 'aminah.hassan@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'program',
                'status' => 'active',
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james.wilson@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'data_analytics',
                'status' => 'inactive',
            ],
            [
                'name' => 'Rina Suzuki',
                'email' => 'rina.suzuki@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'news_events',
                'status' => 'active',
            ],
            [
                'name' => 'Hassan Ali',
                'email' => 'hassan.ali@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'admission',
                'status' => 'active',
            ],
            [
                'name' => 'Sophie Brown',
                'email' => 'sophie.brown@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'moderators',
                'status' => 'active',
            ],
            [
                'name' => 'Dr. Razak Ibrahim',
                'email' => 'razak.ibrahim@politeknikbrunei.edu.bn',
                'role' => 'staff',
                'manager_type' => 'program',
                'status' => 'active',
            ]
        ];

        // Find the first admin user to set as creator (or create a default admin if none exists)
        $adminUser = User::where('role', 'admin')->first();
        
        if (!$adminUser) {
            // Create a default admin if none exists
            $adminUser = User::create([
                'name' => 'System Admin',
                'email' => 'admin@politeknikbrunei.edu.bn',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active',
            ]);
        }

        // Create each staff member
        foreach ($staff as $staffData) {
            User::create([
                'name' => $staffData['name'],
                'email' => $staffData['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => $staffData['role'],
                'status' => $staffData['status'],
                'manager_type' => $staffData['manager_type'],
                'created_by' => $adminUser->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('16 staff members created successfully!');
        $this->command->info('Default password for all staff: 12345678');
    }
}