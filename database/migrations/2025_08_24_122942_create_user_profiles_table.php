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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            // IC File Information
            $table->string('ic_file_path')->nullable();
            $table->string('ic_file_name')->nullable();
            
            // Personal Information
            $table->string('name');
            $table->string('identity_card', 9);
            $table->enum('id_color', ['yellow', 'green', 'red']);
            $table->text('postal_address');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->enum('gender', ['male', 'female']);
            
            // Contact Information
            $table->string('telephone_home', 20)->nullable();
            $table->string('mobile_phone', 20);
            $table->string('email_address');
            
            // Additional Information
            $table->enum('religion', ['islam', 'christianity', 'buddhism', 'hinduism', 'other']);
            $table->string('nationality', 100);
            $table->enum('race', ['malay', 'chinese', 'indian', 'other']);
            
            // Optional Health Information
            $table->text('health_record')->nullable();
            
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes
            $table->index('user_id');
            $table->unique('user_id'); // One profile per user
            $table->index('email_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};