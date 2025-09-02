<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'code' => 'MTH001',
                'name' => 'Matematika',
                'start_time' => '07:30',
                'end_time' => '11:30',
            ],
            [
                'code' => 'PHY002',
                'name' => 'Fisika',
                'start_time' => '08:00',
                'end_time' => '11:00',
            ],
            [
                'code' => 'BIO003',
                'name' => 'Biologi',
                'start_time' => '09:00',
                'end_time' => '12:00',
            ],
            [
                'code' => 'ENG004',
                'name' => 'Bahasa Inggris',
                'start_time' => '10:00',
                'end_time' => '12:00',
            ],
            [
                'code' => 'PKN005',
                'name' => 'Pendidikan Kewarganegaraan',
                'start_time' => '13:00',
                'end_time' => '15:00',
            ],
            [
                'code' => 'HIS006',
                'name' => 'Sejarah',
                'start_time' => '14:00',
                'end_time' => '16:00',
            ],
            [
                'code' => 'CHM007',
                'name' => 'Kimia',
                'start_time' => '08:30',
                'end_time' => '11:30',
            ],
            [
                'code' => 'IND008',
                'name' => 'Bahasa Indonesia',
                'start_time' => '07:00',
                'end_time' => '11:00',
            ],
            [
                'code' => 'GEO009',
                'name' => 'Geografi',
                'start_time' => '13:30',
                'end_time' => '15:30',
            ],
            [
                'code' => 'ECO010',
                'name' => 'Ekonomi',
                'start_time' => '09:30',
                'end_time' => '12:30',
            ],
        ];

        foreach ($subjects as $subjectData) {
            Subject::updateOrCreate(
                ['code' => $subjectData['code']], // Kondisi pencarian
                $subjectData // Data yang akan di-update/create
            );
        }

        $this->command->info('✅ Subjects seeded successfully!');
    }
}
