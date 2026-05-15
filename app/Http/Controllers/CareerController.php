<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'category' => trim((string) $request->query('category', '')),
            'education_level' => trim((string) $request->query('education_level', '')),
        ];

        $query = Career::query()->where('is_active', true);

        if ($filters['q'] !== '') {
            $q = $filters['q'];
            $driver = DB::connection()->getDriverName();
            $query->where(function ($sub) use ($q, $driver) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('education_requirements', 'like', "%{$q}%");

                if (in_array($driver, ['mysql', 'mariadb'], true)) {
                    $sub->orWhereRaw("JSON_SEARCH(required_skills, 'one', ?) IS NOT NULL", [$q]);
                } else {
                    $sub->orWhere('required_skills', 'like', "%{$q}%");
                }
            });
        }

        if ($filters['category'] !== '') {
            $query->where('category', $filters['category']);
        }

        if ($filters['education_level'] !== '') {
            $query->where('education_level', $filters['education_level']);
        }

        $careers = $query->orderBy('title')->paginate(12);

        $recommended = collect();
        $savedCareerIds = [];
        if (auth()->check()) {
            $user = auth()->user();
            $savedCareerIds = $user->savedCareers()->pluck('careers.id')->all();
            $recommended = CareerRecommendation::with('career')
                ->where('user_id', $user->id)
                ->orderByDesc('match_score')
                ->take(6)
                ->get();
        }

        $categories = Career::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->all();

        $educationLevels = [
            'high_school' => 'High School',
            'associate' => 'Associate Degree',
            'bachelor' => "Bachelor's Degree",
            'master' => "Master's Degree",
            'doctorate' => 'Doctorate',
        ];

        $quickFilters = [
            ['value' => 'technology', 'label' => 'Technology', 'icon' => 'fa-laptop-code'],
            ['value' => 'healthcare', 'label' => 'Healthcare', 'icon' => 'fa-heartbeat'],
            ['value' => 'creative', 'label' => 'Creative', 'icon' => 'fa-palette'],
            ['value' => 'business', 'label' => 'Business', 'icon' => 'fa-briefcase'],
        ];

        return view('careers', compact('careers', 'recommended', 'savedCareerIds', 'filters', 'categories', 'educationLevels', 'quickFilters'));
    }

    public function save(Career $career)
    {
        auth()->user()->savedCareers()->syncWithoutDetaching([$career->id]);
        return back()->with('success', 'Career saved successfully.');
    }
}
