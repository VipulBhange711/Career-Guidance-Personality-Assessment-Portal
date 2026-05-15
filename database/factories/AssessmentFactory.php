<?php

namespace Database\Factories;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Assessment>
 */
class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['personality', 'aptitude']);

        return [
            'title' => $type === 'personality' ? 'Personality Assessment' : 'Aptitude Assessment',
            'type' => $type,
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
