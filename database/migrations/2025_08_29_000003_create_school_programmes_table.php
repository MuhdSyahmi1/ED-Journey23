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
        Schema::create('school_programmes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diploma_programme_id');
            $table->enum('school', [
                'business', 
                'health', 
                'ict', 
                'engineering', 
                'petrochemical'
            ]);
            $table->enum('duration', ['1.0', '1.5', '2.0', '2.5', '3.0', '3.5', '4.0', '4.5', '5.0']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('diploma_programme_id')
                  ->references('id')
                  ->on('diploma_programmes')
                  ->onDelete('cascade');

            // Ensure unique combination of programme and school
            $table->unique(['diploma_programme_id', 'school']);
            
            // Index for faster queries
            $table->index(['school', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_programmes');
    }
};