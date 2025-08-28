<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ocr_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('filename');
            $table->text('text');
            $table->string('ocr_type')->default('o_level'); // o_level, a_level, etc
            $table->json('confidence_data')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'ocr_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ocr_results');
    }
};