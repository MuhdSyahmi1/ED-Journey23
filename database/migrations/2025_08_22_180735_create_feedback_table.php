<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            
            // User who submitted the feedback
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Feedback content
            $table->string('subject');
            $table->text('message');
            
            // Feedback status
            $table->enum('status', ['pending', 'in-progress', 'solved'])->default('pending');
            
            // Feedback type (replaces priority - priority is auto-determined)
            $table->enum('feedback_type', [
                'technical_issue',
                'content_error', 
                'feature_request',
                'usability_feedback',
                'course_feedback',
                'general_feedback',
                'account_billing'
            ])->default('general_feedback');
            
            // Priority level - auto-computed based on feedback_type
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            
            // Admin response
            $table->text('admin_reply')->nullable();
            $table->unsignedBigInteger('replied_by')->nullable();
            $table->foreign('replied_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('replied_at')->nullable();
            
            // Tracking fields
            $table->timestamp('resolved_at')->nullable();
            $table->json('attachments')->nullable(); // For future file attachments
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_id', 'status']);
            $table->index(['status', 'priority']);
            $table->index(['feedback_type', 'status']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};