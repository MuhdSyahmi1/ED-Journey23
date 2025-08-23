<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add status field for active/inactive managers
            $table->string('status')->default('active')->after('role');
            
            // Add manager type field for different manager roles
            $table->enum('manager_type', ['program', 'admission', 'both'])->nullable()->after('status');
            
            // Add timestamps for better tracking
            $table->timestamp('last_login_at')->nullable()->after('updated_at');
            
            // Add created by field to track who created this manager
            $table->unsignedBigInteger('created_by')->nullable()->after('last_login_at');
            
            // Add foreign key constraint for created_by
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['created_by']);
            
            // Drop added columns
            $table->dropColumn(['status', 'manager_type', 'last_login_at', 'created_by']);
        });
    }
};