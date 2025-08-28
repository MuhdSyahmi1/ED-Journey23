<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hntec_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ocr_result_id')->constrained()->onDelete('cascade');
            $table->string('programme'); // HNTec programme name
            $table->decimal('cgpa', 3, 2); // 0.00 to 4.00
            $table->text('context_line'); // Original OCR text context
            $table->decimal('confidence', 3, 2); // 0.00 to 1.00
            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['cgpa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hntec_results');
    }
};