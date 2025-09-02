<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeachersSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data teacher lama (ini aman karena teacher tidak di-reference foreign key)
        Teacher::query()->delete();
        
        // Reset counter factory untuk memastikan urutan dari awal
        \Database\Factories\TeacherFactory::resetCounter();
        
        // Generate 10 teachers (sesuai jumlah subjects)
        Teacher::factory()->count(10)->create();
    }
}