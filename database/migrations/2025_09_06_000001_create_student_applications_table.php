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
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_programme_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'waitlisted'])->default('pending');
            $table->tinyInteger('preference_rank'); // 1 for first choice, 2 for second choice
            $table->timestamp('applied_at');
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('review_notes')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index(['school_programme_id', 'status']);
            $table->index('applied_at');
            
            // Constraints
            $table->unique(['user_id', 'school_programme_id'], 'unique_user_programme_application');
            $table->unique(['user_id', 'preference_rank'], 'unique_user_preference_rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};