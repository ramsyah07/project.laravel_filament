<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('exam_banks', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->after('subject_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('exam_banks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('teacher_id');
        });
    }
};
