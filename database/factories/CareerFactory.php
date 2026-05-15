<?php

namespace Database\Factories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Career>
 */
class CareerFactory extends Factory
{
    protected $model = Career::class;

    public function definition(): array
    {
        $categories = ['technology', 'healthcare', 'education', 'business', 'creative', 'engineering'];
        $educationLevels = ['high_school', 'associate', 'bachelor', 'master', 'doctorate'];

        $skills = collect([
            'Communication', 'Problem-solving', 'Critical thinking', 'Teamwork', 'Time management',
            'Programming', 'Data analysis', 'Design', 'Leadership', 'Research',
        ])->shuffle()->take(fake()->numberBetween(2, 5))->values()->all();

        return [
            'title' => fake()->jobTitle(),
            'category' => fake()->randomElement($categories),
            'description' => fake()->paragraphs(3, true),
            'required_skills' => $skills,
            'education_requirements' => fake()->randomElement([
                "High School Diploma",
                "Associate Degree",
                "Bachelor's Degree",
                "Master's Degree",
                "Doctorate / PhD",
            ]),
            'education_level' => fake()->randomElement($educationLevels),
            'salary_range' => fake()->randomElement(['3 LPA - 6 LPA', '6 LPA - 12 LPA', '10 LPA - 18 LPA', '15 LPA - 30 LPA']),
            'job_outlook' => fake()->randomElement(['Excellent', 'Good', 'Moderate']),
            'work_environment' => fake()->randomElement(['Office', 'Remote', 'Hybrid', 'Field']),
            'personality_matches' => collect(['Analytical', 'Creative', 'Social', 'Detail-oriented', 'Leadership'])
                ->shuffle()
                ->take(fake()->numberBetween(1, 3))
                ->values()
                ->all(),
            'aptitude_requirements' => [
                'logical' => fake()->numberBetween(50, 90),
                'numerical' => fake()->numberBetween(50, 90),
                'verbal' => fake()->numberBetween(50, 90),
            ],
            'is_active' => true,
        ];
    }
}
