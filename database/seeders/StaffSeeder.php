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
        // Create 5 staff/managers with different roles and specializations
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
                'manager_type' => 'both',
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
                'manager_type' => 'both',
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

        $this->command->info('5 staff members created successfully!');
        $this->command->info('Default password for all staff: 12345678');
    }
}