<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->enum('verification_status', ['pending', 'verified'])->default('pending')->after('health_record');
            $table->timestamp('verified_at')->nullable()->after('verification_status');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
            
            // Foreign key for who verified the profile
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');
            
            // Index for verification status
            $table->index('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropIndex(['verification_status']);
            $table->dropColumn(['verification_status', 'verified_at', 'verified_by']);
        });
    }
};