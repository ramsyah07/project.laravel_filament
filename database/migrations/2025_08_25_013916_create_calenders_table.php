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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year'); // contoh: 2025/2026
            $table->enum('semester', ['Ganjil', 'Genap']); // semester
            $table->string('event'); // nama kegiatan, ex: Ujian Akhir Semester
            $table->date('start_date'); // tanggal mulai kegiatan
            $table->date('end_date')->nullable(); // tanggal selesai (boleh null)
            $table->text('description')->nullable(); // catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};

