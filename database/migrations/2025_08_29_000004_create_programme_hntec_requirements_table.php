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
        Schema::create('programme_hntec_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_programme_id');
            $table->unsignedBigInteger('hntec_programme_id');
            $table->enum('category', ['Relevant', 'Not Relevant']);
            $table->decimal('min_cgpa', 3, 2); // Format: X.XX (1.00 to 4.00)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('school_programme_id')
                  ->references('id')
                  ->on('school_programmes')
                  ->onDelete('cascade');

            $table->foreign('hntec_programme_id')
                  ->references('id')
                  ->on('hntec_programmes')
                  ->onDelete('cascade');

            // Ensure unique combination per school programme and hntec programme
            $table->unique(['school_programme_id', 'hntec_programme_id'], 'unique_programme_hntec');
            
            // Indexes for faster queries
            $table->index(['school_programme_id', 'category']);
            $table->index('min_cgpa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_hntec_requirements');
    }
};