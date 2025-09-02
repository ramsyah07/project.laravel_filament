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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kelas (e.g., "X-IPA-1", "XI-IPS-2")
            $table->string('code')->unique(); // Kode kelas (e.g., "X1", "XI2")
            $table->string('grade_level'); // Tingkat kelas (e.g., "10", "11", "12")
            $table->string('major')->nullable(); // Jurusan (e.g., "IPA", "IPS", "Bahasa")
            $table->string('room_number')->nullable(); // Nomor ruangan
            $table->string('building')->nullable(); // Gedung
            $table->string('floor')->nullable(); // Lantai
            $table->timestamps();
            
            // Indexes
            $table->index(['grade_level', 'major']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};