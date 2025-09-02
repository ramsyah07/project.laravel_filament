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
        Schema::table('exam_banks', function (Blueprint $table) {
            // Tambah kolom difficulty level
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])
                  ->default('medium')
                  ->after('answer')
                  ->comment('Tingkat kesulitan soal');

            // Tambah kolom question type
            $table->enum('question_type', ['multiple_choice', 'essay', 'true_false'])
                  ->default('multiple_choice')
                  ->after('difficulty_level')
                  ->comment('Jenis soal');

            // Tambah kolom explanation
            $table->text('explanation')
                  ->nullable()
                  ->after('question_type')
                  ->comment('Penjelasan jawaban');

            // Tambah kolom points/bobot nilai
            $table->unsignedInteger('points')
                  ->default(1)
                  ->after('explanation')
                  ->comment('Bobot nilai soal');

            // Tambah kolom status aktif
            $table->boolean('is_active')
                  ->default(true)
                  ->after('points')
                  ->comment('Status aktif soal');

            // Tambah index untuk performance
            $table->index(['subject_id', 'difficulty_level']);
            $table->index(['is_active', 'question_type']);
            $table->index('difficulty_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_banks', function (Blueprint $table) {
            // Drop indexes dulu
            $table->dropIndex(['subject_id', 'difficulty_level']);
            $table->dropIndex(['is_active', 'question_type']);
            $table->dropIndex(['difficulty_level']);
            
            // Drop columns
            $table->dropColumn([
                'difficulty_level',
                'question_type', 
                'explanation',
                'points',
                'is_active'
            ]);
        });
    }
};

