<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        $isLikert = fake()->boolean();

        if ($isLikert) {
            return [
                'question_text' => fake()->sentence().'? ',
                'question_type' => 'likert_scale',
                'category' => fake()->randomElement(['Social', 'Analytical', 'Creative', 'Leadership']),
                'options' => ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'],
                'correct_option' => null,
                'display_order' => 1,
            ];
        }

        $a = fake()->numberBetween(2, 20);
        $b = fake()->numberBetween(2, 20);

        return [
            'question_text' => "What is {$a} + {$b}?",
            'question_type' => 'multiple_choice',
            'category' => fake()->randomElement(['Numerical', 'Logical', 'Verbal']),
            'options' => [$a + $b, $a + $b + 1, $a + $b - 1, $a + $b + 2],
            'correct_option' => 0,
            'display_order' => 1,
        ];
    }
}
