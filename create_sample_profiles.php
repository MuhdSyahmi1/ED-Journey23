<?php

// Simple script to create sample user profiles directly in database
echo "Creating sample user profiles...\n";

try {
    // Connect to MySQL database directly
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=eddb', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    // Sample profiles with proper enum values
    $profiles = [
        [
            'user_id' => 1,
            'name' => 'Ahmad Hasan bin Abdullah',
            'identity_card' => '12-345678',
            'id_color' => 'yellow',
            'postal_address' => 'No. 123, Jalan Keramat, Kampong Kiulap, BB3713',
            'date_of_birth' => '2005-03-15',
            'place_of_birth' => 'Bandar Seri Begawan',
            'gender' => 'male',
            'telephone_home' => '2234567',
            'mobile_phone' => '8901234',
            'email_address' => 'ahmad.hasan@email.com',
            'religion' => 'islam',
            'nationality' => 'Bruneian',
            'race' => 'malay',
            'health_record' => 'No major health issues.',
            'verification_status' => 'pending',
            'verified_at' => null,
            'verified_by' => null,
        ],
        [
            'user_id' => 2,
            'name' => 'Siti Aminah binti Ibrahim',
            'identity_card' => '15-234567',
            'id_color' => 'yellow',
            'postal_address' => 'No. 456, Jalan Muara, Kampong Serasa, KB1131',
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
            'verified_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            'verified_by' => 1,
        ],
        [
            'user_id' => 3,
            'name' => 'Chen Wei Ming',
            'identity_card' => '18-876543',
            'id_color' => 'green',
            'postal_address' => 'No. 789, Jalan Gadong, Kampong Gadong BE, BE3919',
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
            'verified_at' => null,
            'verified_by' => null,
        ],
        [
            'user_id' => 4,
            'name' => 'Raj Kumar Patel',
            'identity_card' => '20-654321',
            'id_color' => 'red',
            'postal_address' => 'No. 321, Jalan Tutong, Kampong Tungku, TA1341',
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
            'verified_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
            'verified_by' => 1,
        ],
        [
            'user_id' => 5,
            'name' => 'Sarah Jessica Thompson',
            'identity_card' => '16-432109',
            'id_color' => 'red',
            'postal_address' => 'No. 654, Jalan Seria, Kampong Seria, KB1110',
            'date_of_birth' => '2005-05-18',
            'place_of_birth' => 'Seria',
            'gender' => 'female',
            'telephone_home' => null,
            'mobile_phone' => '8456789',
            'email_address' => 'sarah.thompson@email.com',
            'religion' => 'christianity',
            'nationality' => 'American',
            'race' => 'other',
            'health_record' => 'Lactose intolerant.',
            'verification_status' => 'pending',
            'verified_at' => null,
            'verified_by' => null,
        ],
    ];
    
    $stmt = $pdo->prepare("
        INSERT INTO user_profiles (
            user_id, ic_file_path, ic_file_name, name, identity_card, id_color, 
            postal_address, date_of_birth, place_of_birth, gender, telephone_home, 
            mobile_phone, email_address, religion, nationality, race, health_record, 
            verification_status, verified_at, verified_by, created_at, updated_at
        ) VALUES (
            :user_id, :ic_file_path, :ic_file_name, :name, :identity_card, :id_color,
            :postal_address, :date_of_birth, :place_of_birth, :gender, :telephone_home,
            :mobile_phone, :email_address, :religion, :nationality, :race, :health_record,
            :verification_status, :verified_at, :verified_by, NOW(), NOW()
        )
        ON DUPLICATE KEY UPDATE user_id = user_id
    ");
    
    $created = 0;
    foreach ($profiles as $profile) {
        $profile['ic_file_path'] = null;
        $profile['ic_file_name'] = null;
        
        if ($stmt->execute($profile)) {
            if ($pdo->lastInsertId()) {
                $created++;
                echo "✓ Created profile: " . $profile['name'] . " (Status: " . $profile['verification_status'] . ")\n";
            } else {
                echo "- Profile already exists: " . $profile['name'] . "\n";
            }
        }
    }
    
    echo "\n=== Summary ===\n";
    echo "Profiles created: $created\n";
    
    // Get current counts
    $totalStmt = $pdo->query("SELECT COUNT(*) as total FROM user_profiles");
    $total = $totalStmt->fetch()['total'];
    
    $verifiedStmt = $pdo->query("SELECT COUNT(*) as verified FROM user_profiles WHERE verification_status = 'verified'");
    $verified = $verifiedStmt->fetch()['verified'];
    
    $pendingStmt = $pdo->query("SELECT COUNT(*) as pending FROM user_profiles WHERE verification_status = 'pending'");
    $pending = $pendingStmt->fetch()['pending'];
    
    echo "Total profiles in database: $total\n";
    echo "Verified: $verified | Pending: $pending\n";
    echo "\nUser Profile seeder completed successfully!\n";
    
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}