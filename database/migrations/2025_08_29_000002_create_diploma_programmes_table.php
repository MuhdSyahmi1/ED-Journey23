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
        if (!Schema::hasTable('diploma_programmes')) {
            Schema::create('diploma_programmes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('duration', ['1.0', '1.5', '2.0', '2.5', '3.0', '3.5', '4.0', '4.5', '5.0']);
                $table->enum('school', [
                    'School of Business', 
                    'School of Health Sciences', 
                    'School of ICT', 
                    'School of Science & Engineering', 
                    'School of Petrochemical'
                ]);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diploma_programmes');
    }
};