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
    Schema::table('students', function (Blueprint $table) {
        $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropConstrainedForeignId('classroom_id');
    });
}

};
