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
        Schema::create('a_level_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('qualification', ['Advanced Subsidiary', 'Advanced Level']);
            $table->timestamps();
            
            $table->unique(['name', 'qualification']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_level_subjects');
    }
};