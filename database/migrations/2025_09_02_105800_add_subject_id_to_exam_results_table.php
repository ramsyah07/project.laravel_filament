<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->after('exam_id')->constrained()->cascadeOnDelete();
        });

        // Backfill existing records from related exam_banks
        DB::statement('UPDATE exam_results er JOIN exam_banks eb ON er.exam_id = eb.id SET er.subject_id = eb.subject_id WHERE er.subject_id IS NULL');
    }

    public function down(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dropConstrainedForeignId('subject_id');
        });
    }
};
