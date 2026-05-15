<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Career;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $admin = User::updateOrCreate(
            ['email' => 'admin@careerportal.com'],
            [
                'name' => 'System Admin',
                'username' => 'admin',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
        $admin->profile()->firstOrCreate();

        $user = User::updateOrCreate(
            ['email' => 'student@careerportal.com'],
            [
                'name' => 'Student User',
                'username' => 'student',
                'password' => Hash::make('Password@123'),
                'role' => 'user',
                'is_active' => true,
            ]
        );
        $user->profile()->firstOrCreate();

        $personality = Assessment::updateOrCreate(['type' => 'personality'], ['title' => 'Personality Assessment', 'description' => 'Trait and behavior analysis']);
        $aptitude = Assessment::updateOrCreate(['type' => 'aptitude'], ['title' => 'Aptitude Assessment', 'description' => 'Logical and numerical analysis']);

        $personality->questions()->delete();
        $personality->questions()->createMany([
            ['question_text' => 'I prefer to work alone rather than in a team', 'question_type' => 'likert_scale', 'category' => 'Social', 'options' => ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'], 'display_order' => 1],
            ['question_text' => 'I enjoy solving complex problems', 'question_type' => 'likert_scale', 'category' => 'Analytical', 'options' => ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'], 'display_order' => 2],
        ]);
        $personality->questions()->saveMany(
            \App\Models\Question::factory()
                ->count(8)
                ->state(['question_type' => 'likert_scale', 'options' => ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']])
                ->make()
                ->each(function ($q, $i) {
                    $q->display_order = $i + 3;
                    $q->correct_option = null;
                })
        );

        $aptitude->questions()->delete();
        $aptitude->questions()->createMany([
            ['question_text' => 'What is next: 2, 4, 8, 16, ?', 'question_type' => 'multiple_choice', 'category' => 'Logical', 'options' => ['20', '24', '32', '28'], 'correct_option' => 2, 'display_order' => 1],
            ['question_text' => '20 discounted by 25% = ?', 'question_type' => 'multiple_choice', 'category' => 'Numerical', 'options' => ['15', '18', '12', '25'], 'correct_option' => 0, 'display_order' => 2],
        ]);
        $aptitude->questions()->saveMany(
            \App\Models\Question::factory()
                ->count(8)
                ->state(['question_type' => 'multiple_choice', 'correct_option' => 0])
                ->make()
                ->each(function ($q, $i) {
                    $q->display_order = $i + 3;
                })
        );

        Career::query()->delete();
        Career::factory()->count(18)->create();

        Career::create([
            'title' => 'Software Developer',
            'category' => 'technology',
            'description' => 'Design and develop software systems.',
            'required_skills' => ['Programming', 'Problem-solving'],
            'education_requirements' => "Bachelor's in Computer Science",
            'education_level' => 'bachelor',
            'salary_range' => '6 LPA - 18 LPA',
            'job_outlook' => 'Excellent',
            'work_environment' => 'Office/Remote',
            'personality_matches' => ['Analytical', 'Logical'],
            'aptitude_requirements' => ['logical' => 80, 'numerical' => 75],
        ]);
    }
}
