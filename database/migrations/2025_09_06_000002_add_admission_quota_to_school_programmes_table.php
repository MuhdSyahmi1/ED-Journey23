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
        Schema::table('school_programmes', function (Blueprint $table) {
            $table->integer('admission_quota')->nullable()->after('duration');
            $table->index('admission_quota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_programmes', function (Blueprint $table) {
            $table->dropIndex(['admission_quota']);
            $table->dropColumn('admission_quota');
        });
    }
};