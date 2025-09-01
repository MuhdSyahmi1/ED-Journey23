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
        Schema::create('programme_olevel_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_programme_id');
            $table->unsignedBigInteger('o_level_subject_id');
            $table->enum('category', ['Compulsory', 'General']);
            $table->enum('min_grade', ['A*', 'A(a)', 'B(b)', 'C(c)', 'D(d)', 'E(e)', 'F(f)', 'U']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('school_programme_id')
                  ->references('id')
                  ->on('school_programmes')
                  ->onDelete('cascade');

            $table->foreign('o_level_subject_id')
                  ->references('id')
                  ->on('o_level_subjects')
                  ->onDelete('cascade');

            // Ensure unique combination per school programme and o level subject
            $table->unique(['school_programme_id', 'o_level_subject_id'], 'unique_programme_olevel');
            
            // Indexes for faster queries
            $table->index(['school_programme_id', 'category']);
            $table->index('min_grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_olevel_requirements');
    }
};