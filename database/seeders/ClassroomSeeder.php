<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya seed jika belum ada data
        if (Classroom::count() == 0) {
            Classroom::factory()->count(15)->create();
        }
    }
}