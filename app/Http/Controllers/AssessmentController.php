<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentAttempt;
use App\Models\Career;
use App\Models\CareerRecommendation;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessments = Assessment::where('is_active', true)->withCount('questions')->get();
        $recentAttempts = AssessmentAttempt::with('assessment')
            ->where('user_id', auth()->id())
            ->latest('submitted_at')
            ->take(4)
            ->get();

        return view('assessment', compact('assessments', 'recentAttempts'));
    }

    public function show(Assessment $assessment)
    {
        $assessment->load('questions');
        return view('assessment', compact('assessment'));
    }

    public function submit(Request $request, Assessment $assessment)
    {
        $questions = $assessment->questions;
        $request->validate(['answers' => ['required', 'array']]);

        foreach ($questions as $question) {
            if (!$request->has("answers.{$question->id}")) {
                return back()->withInput()->with('error', 'Please answer all questions before submitting.');
            }
        }

        $attempt = AssessmentAttempt::create([
            'user_id' => auth()->id(),
            'assessment_id' => $assessment->id,
            'submitted_at' => now(),
        ]);

        $correct = 0;
        foreach ($questions as $question) {
            $selected = (int) ($request->input("answers.{$question->id}") ?? 0);
            AssessmentAnswer::create([
                'assessment_attempt_id' => $attempt->id,
                'question_id' => $question->id,
                'selected_option' => $selected,
            ]);

            if ($assessment->type === 'aptitude' && $question->correct_option !== null && $selected === (int) $question->correct_option) {
                $correct++;
            }
        }

        $score = $assessment->type === 'aptitude' && $questions->count() > 0
            ? round(($correct / $questions->count()) * 100, 2)
            : rand(70, 95);

        $attempt->update(['score' => $score, 'result_payload' => ['score' => $score]]);

        Career::where('is_active', true)->take(5)->get()->each(function ($career) use ($attempt) {
            CareerRecommendation::updateOrCreate(
                ['user_id' => auth()->id(), 'career_id' => $career->id],
                ['assessment_attempt_id' => $attempt->id, 'match_score' => rand(60, 95)]
            );
        });

        return redirect()->route('results.show', $attempt)->with('success', 'Assessment submitted successfully.');
    }

    public function results(AssessmentAttempt $attempt)
    {
        abort_unless($attempt->user_id === auth()->id() || auth()->user()->role === 'admin', 403);
        $attempt->load('assessment', 'answers.question');
        $recommendations = CareerRecommendation::with('career')
            ->where('user_id', $attempt->user_id)
            ->orderByDesc('match_score')
            ->take(6)
            ->get();

        return view('results', compact('attempt', 'recommendations'));
    }

    public function download(AssessmentAttempt $attempt)
    {
        abort_unless($attempt->user_id === auth()->id() || auth()->user()->role === 'admin', 403);
        $attempt->load('assessment', 'answers.question');

        $filename = 'assessment-report-'.$attempt->id.'.html';
        $html = view('results', [
            'attempt' => $attempt,
            'recommendations' => CareerRecommendation::with('career')
                ->where('user_id', $attempt->user_id)
                ->orderByDesc('match_score')
                ->take(6)
                ->get(),
        ])->render();

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
