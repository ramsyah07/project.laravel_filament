<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    protected $model = Classroom::class;
    
    private static $classCounter = 0;
    private static $classes = [
        // Kelas 10
        ['grade' => 'X', 'major' => 'IPA', 'code' => 'X-A1'],
        ['grade' => 'X', 'major' => 'IPA', 'code' => 'X-A2'],
        ['grade' => 'X', 'major' => 'IPS', 'code' => 'X-S1'],
        ['grade' => 'X', 'major' => 'IPS', 'code' => 'X-S2'],
        ['grade' => 'X', 'major' => 'Bahasa', 'code' => 'X-B1'],
        
        // Kelas 11
        ['grade' => 'XI', 'major' => 'IPA', 'code' => 'XI-A1'],
        ['grade' => 'XI', 'major' => 'IPA', 'code' => 'XI-A2'],
        ['grade' => 'XI', 'major' => 'IPS', 'code' => 'XI-S1'],
        ['grade' => 'XI', 'major' => 'IPS', 'code' => 'XI-S2'],
        ['grade' => 'XI', 'major' => 'Bahasa', 'code' => 'XI-B1'],
        
        // Kelas 12
        ['grade' => 'XII', 'major' => 'IPA', 'code' => 'XII-A1'],
        ['grade' => 'XII', 'major' => 'IPA', 'code' => 'XII-A2'],
        ['grade' => 'XII', 'major' => 'IPS', 'code' => 'XII-S1'],
        ['grade' => 'XII', 'major' => 'IPS', 'code' => 'XII-S2'],
        ['grade' => 'XII', 'major' => 'Bahasa', 'code' => 'XII-B1'],
    ];

    public function definition(): array
    {
        // Ambil data kelas berdasarkan counter
        $classData = self::$classes[self::$classCounter % count(self::$classes)];
        self::$classCounter++;
        
        $gradeLevel = $classData['grade'];
        $major = $classData['major'];
        $code = $classData['code'];
        $name = "{$gradeLevel} {$major} " . substr($code, strrpos($code, '-') + 1); // Ambil bagian setelah '-'
        
        return [
            'name'        => $name,
            'code'        => $code,
            'grade_level' => $gradeLevel,
            'major'       => $major,
            'room_number' => $this->faker->numberBetween(101, 305),
            'building'    => $this->faker->randomElement(['A', 'B', 'C']),
            'floor'       => $this->faker->numberBetween(1, 3),
        ];
    }
}