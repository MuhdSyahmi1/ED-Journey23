<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the verification_status enum to include 'rejected'
        DB::statement("ALTER TABLE user_profiles MODIFY COLUMN verification_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE user_profiles MODIFY COLUMN verification_status ENUM('pending', 'verified') DEFAULT 'pending'");
    }
};