<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Hapus kolom lama kalau sudah ada
            if (Schema::hasColumn('students', 'entry_year')) {
                $table->dropColumn('entry_year');
            }

            // Tambah kolom baru
            $table->year('entry_year_start')->nullable();
            $table->year('entry_year_end')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['entry_year_start', 'entry_year_end']);
            $table->string('entry_year')->nullable(); // restore kalau rollback
        });
    }
};
