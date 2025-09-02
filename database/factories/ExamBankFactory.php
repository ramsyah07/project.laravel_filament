<?php

namespace Database\Factories;

use App\Models\ExamBank;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 * <\App\Models\ExamBank>
 */
class ExamBankFactory extends Factory
{
    protected $model = ExamBankFactory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $questionTypes = ['multiple_choice', 'essay', 'true_false'];
        $difficulties = ['easy', 'medium', 'hard'];
        
        $questionType = $this->faker->randomElement($questionTypes);
        
        return [
            'subject_id' => Subject::factory(),
            'question_text' => $this->generateQuestionText($questionType),
            'options' => $this->generateOptions($questionType),
            'answer' => $this->generateAnswer($questionType),
            'difficulty_level' => $this->faker->randomElement($difficulties),
            'question_type' => $questionType,
            'explanation' => $this->faker->boolean(70) ? $this->faker->paragraph(2) : null,
            'points' => $this->faker->randomElement([1, 2, 3, 5, 10]),
            'is_active' => $this->faker->boolean(85), // 85% chance active
        ];
    }

    /**
     * Generate question text based on type
     */
    private function generateQuestionText(string $type): string
    {
        $questions = [
            'multiple_choice' => [
                'Manakah dari pilihan berikut yang merupakan ibu kota Indonesia?',
                'Hasil dari 15 + 25 × 2 adalah...',
                'Planet yang paling dekat dengan matahari adalah...',
                'Siapakah presiden pertama Indonesia?',
                'Proses fotosintesis terjadi pada bagian tumbuhan yang disebut...',
            ],
            'essay' => [
                'Jelaskan proses terjadinya hujan!',
                'Uraikan dampak positif dan negatif teknologi dalam kehidupan sehari-hari!',
                'Bagaimana cara menjaga kelestarian lingkungan hidup?',
                'Jelaskan pentingnya pendidikan bagi masa depan bangsa!',
                'Uraikan proses kemerdekaan Indonesia secara singkat!',
            ],
            'true_false' => [
                'Indonesia merdeka pada tanggal 17 Agustus 1945',
                'Matahari mengelilingi bumi',
                'Air mendidih pada suhu 100 derajat Celsius',
                'Jakarta adalah ibu kota Indonesia',
                'Fotosintesis memerlukan bantuan sinar matahari',
            ],
        ];

        return $this->faker->randomElement($questions[$type]);
    }

    /**
     * Generate options based on question type
     */
    private function generateOptions(string $type): array
    {
        switch ($type) {
            case 'multiple_choice':
                return [
                    $this->faker->words(2, true),
                    $this->faker->words(2, true),
                    $this->faker->words(2, true),
                    $this->faker->words(2, true),
                ];
            
            case 'true_false':
                return ['Benar', 'Salah'];
            
            case 'essay':
            default:
                return []; // Essay doesn't need options
        }
    }

    /**
     * Generate answer based on question type
     */
    private function generateAnswer(string $type): string
    {
        switch ($type) {
            case 'multiple_choice':
                $options = ['A', 'B', 'C', 'D'];
                return $this->faker->randomElement($options);
            
            case 'true_false':
                return $this->faker->randomElement(['Benar', 'Salah']);
            
            case 'essay':
                return $this->faker->paragraph(3);
            
            default:
                return 'A';
        }
    }

    /**
     * State for multiple choice questions
     */
    public function multipleChoice(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'question_type' => 'multiple_choice',
                'options' => [
                    $this->faker->words(2, true),
                    $this->faker->words(2, true), 
                    $this->faker->words(2, true),
                    $this->faker->words(2, true),
                ],
                'answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            ];
        });
    }

    /**
     * State for essay questions
     */
    public function essay(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'question_type' => 'essay',
                'options' => [],
                'answer' => $this->faker->paragraph(3),
            ];
        });
    }

    /**
     * State for true/false questions
     */
    public function trueFalse(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'question_type' => 'true_false',
                'options' => ['Benar', 'Salah'],
                'answer' => $this->faker->randomElement(['Benar', 'Salah']),
            ];
        });
    }

    /**
     * State for easy difficulty
     */
    public function easy(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'easy',
            'points' => $this->faker->randomElement([1, 2]),
        ]);
    }

    /**
     * State for medium difficulty
     */
    public function medium(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'medium',
            'points' => $this->faker->randomElement([2, 3, 5]),
        ]);
    }

    /**
     * State for hard difficulty
     */
    public function hard(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'hard',
            'points' => $this->faker->randomElement([5, 10]),
        ]);
    }

    /**
     * State for active questions
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}