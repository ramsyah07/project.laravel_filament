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
        Schema::table('schedules', function (Blueprint $table) {
            // Check if the column exists and add foreign key constraint only
            if (Schema::hasColumn('schedules', 'classroom_id')) {
                // Add the foreign key constraint
                $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            if (Schema::hasColumn('schedules', 'classroom_id')) {
                $table->dropForeign(['classroom_id']);
            }
        });
    }
};