<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('user_questionnaire_responses');
    }

    public function down(): void
    {
        Schema::create('user_questionnaire_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('responses');
            $table->json('scores');
            $table->string('recommended_school');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }
};