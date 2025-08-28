<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ocr_result_id')->constrained()->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->string('syllabus')->nullable();
            $table->string('grade'); // Required for O-Level and A-Level
            $table->string('qualification')->nullable(); // O Level, A Level, Advanced Level, Advanced Subsidiary
            $table->string('series')->nullable(); // Exam series/session
            $table->integer('percentage')->nullable(); // For percentage scores
            $table->text('context_line');
            $table->decimal('confidence', 3, 2); // 0.00 to 1.00
            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['grade']);
            $table->index(['qualification']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};