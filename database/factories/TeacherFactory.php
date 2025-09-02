<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    protected $model = Teacher::class;
    
    private static $teacherCounter = 0;
    
    // Teachers with unique mapping (1 teacher = 1 subject)
    private static $teacherSubjectMapping = [
        ['name' => 'Ahmad Rizki, S.Pd.Mat.', 'subject_code' => 'MTH001'],      // Matematika
        ['name' => 'Siti Nurhaliza, S.Pd.Fis.', 'subject_code' => 'PHY002'],   // Fisika
        ['name' => 'Budi Santoso, S.Pd.Bio.', 'subject_code' => 'BIO003'],     // Biologi
        ['name' => 'Dewi Sartika, S.Pd.Ing.', 'subject_code' => 'ENG004'],     // Bahasa Inggris
        ['name' => 'Nugraha, S.Pd.I.', 'subject_code' => 'PKN005'],            // PKN
        ['name' => 'Fitri Handayani, S.Pd.Sej.', 'subject_code' => 'HIS006'],  // Sejarah
        ['name' => 'Gunawan Hidayat, S.Pd.Kim.', 'subject_code' => 'CHM007'],  // Kimia
        ['name' => 'Indah Lestari, S.Pd.', 'subject_code' => 'IND008'],        // Bahasa Indonesia
        ['name' => 'Anggun Fergina, S.Pd.Geo.', 'subject_code' => 'GEO009'],   // Geografi
        ['name' => 'Maya Anggraini, S.E.', 'subject_code' => 'ECO010'],        // Ekonomi
    ];

    public function definition(): array
    {
        // Ambil data teacher berdasarkan counter (sequential, tidak random)
        $teacherData = self::$teacherSubjectMapping[self::$teacherCounter % count(self::$teacherSubjectMapping)];
        self::$teacherCounter++;
        
        $fullName = $teacherData['name'];
        $subjectCode = $teacherData['subject_code'];
        
        // Get subject ID by code
        $subjectId = Subject::where('code', $subjectCode)->value('id');
        
        // Extract name only for email (remove title part)
        $nameOnly = explode(', ', $fullName)[0];
        
        // Generate NIP format: YYYYMMDDYYYYMMDDXX
        $birthYear = $this->faker->numberBetween(1980, 1995);
        $birthMonth = $this->faker->numberBetween(1, 12);
        $birthDay = $this->faker->numberBetween(1, 28);
        $hireYear = $this->faker->numberBetween(2005, 2020);
        $hireMonth = $this->faker->numberBetween(1, 12);
        $hireDay = $this->faker->numberBetween(1, 28);
        $sequence = self::$teacherCounter; // Gunakan counter untuk sequence unique
        
        $nip = sprintf(
            '%04d%02d%02d%04d%02d%02d%02d',
            $birthYear, $birthMonth, $birthDay,
            $hireYear, $hireMonth, $hireDay,
            $sequence
        );
        
        // Create unique email using counter
        $emailBase = strtolower(str_replace([' ', '.', ','], ['', '', ''], $nameOnly));
        $email = $emailBase . self::$teacherCounter . '@school.edu';
        
        return [
            'nip' => $nip,
            'name' => $fullName,
            'email' => $email,
            'contact' => '0812' . $this->faker->numerify('########'),
            'subject_id' => $subjectId,
        ];
    }
    
    /**
     * Reset counter for fresh seeding
     */
    public static function resetCounter(): void
    {
        self::$teacherCounter = 0;
    }
}