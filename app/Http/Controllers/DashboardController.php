<?php

namespace App\Http\Controllers;

use App\Models\AssessmentAttempt;
use App\Models\CareerRecommendation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $latestAttempts = AssessmentAttempt::with('assessment')
            ->where('user_id', $user->id)
            ->latest('submitted_at')
            ->take(5)
            ->get();

        $recommendations = CareerRecommendation::with('career')
            ->where('user_id', $user->id)
            ->orderByDesc('match_score')
            ->take(6)
            ->get();

        $stats = [
            'assessments_completed' => AssessmentAttempt::where('user_id', $user->id)->count(),
            'saved_careers' => $user->savedCareers()->count(),
            'recommendations' => $recommendations->count(),
        ];

        $profile = $user->profile;
        $profileFields = [
            $user->name,
            $user->username,
            $user->email,
            $profile?->date_of_birth,
            $profile?->gender,
            $profile?->phone,
            $profile?->address,
            $profile?->education_level,
            $profile?->current_education,
            $profile?->interests,
            $profile?->career_goals,
        ];
        $filled = collect($profileFields)->filter(function ($value) {
            return $value !== null && trim((string) $value) !== '';
        })->count();
        $profileCompletion = (int) round(($filled / count($profileFields)) * 100);

        $chartScores = [
            'labels' => $latestAttempts->reverse()->map(fn ($a) => optional($a->submitted_at)->format('d M'))->values(),
            'values' => $latestAttempts->reverse()->map(fn ($a) => (float) ($a->score ?? 0))->values(),
        ];
        $chartRecommendations = [
            'labels' => $recommendations->reverse()->map(fn ($r) => str($r->career?->title ?? 'Career')->limit(14))->values(),
            'values' => $recommendations->reverse()->map(fn ($r) => (float) ($r->match_score ?? 0))->values(),
        ];

        return view('dashboard', compact('latestAttempts', 'recommendations', 'stats', 'profileCompletion', 'chartScores', 'chartRecommendations'));
    }
}
