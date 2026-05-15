<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::query()->orderByDesc('created_at')->paginate(15);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        $educationLevels = [
            'high_school' => 'High School',
            'associate' => 'Associate Degree',
            'bachelor' => "Bachelor's Degree",
            'master' => "Master's Degree",
            'doctorate' => 'Doctorate',
        ];

        return view('admin.careers.create', compact('educationLevels'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCareer($request);

        Career::create($validated);
        return redirect()->route('admin.careers.index')->with('success', 'Career created successfully.');
    }

    public function edit(Career $career)
    {
        $educationLevels = [
            'high_school' => 'High School',
            'associate' => 'Associate Degree',
            'bachelor' => "Bachelor's Degree",
            'master' => "Master's Degree",
            'doctorate' => 'Doctorate',
        ];

        return view('admin.careers.edit', compact('career', 'educationLevels'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $this->validateCareer($request);

        $career->update($validated);
        return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Career deleted successfully.');
    }

    private function validateCareer(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'required_skills' => ['nullable', 'string'],
            'education_requirements' => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'in:high_school,associate,bachelor,master,doctorate'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'job_outlook' => ['nullable', 'string', 'max:255'],
            'work_environment' => ['nullable', 'string', 'max:255'],
            'personality_matches' => ['nullable', 'string'],
            'aptitude_logical' => ['nullable', 'integer', 'min:0', 'max:100'],
            'aptitude_numerical' => ['nullable', 'integer', 'min:0', 'max:100'],
            'aptitude_verbal' => ['nullable', 'integer', 'min:0', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        return [
            'title' => $data['title'],
            'category' => $data['category'] ?? null,
            'description' => $data['description'],
            'required_skills' => !empty($data['required_skills'])
                ? collect(explode(',', $data['required_skills']))->map(fn ($s) => trim($s))->filter()->values()->all()
                : null,
            'education_requirements' => $data['education_requirements'] ?? null,
            'education_level' => $data['education_level'] ?? null,
            'salary_range' => $data['salary_range'] ?? null,
            'job_outlook' => $data['job_outlook'] ?? null,
            'work_environment' => $data['work_environment'] ?? null,
            'personality_matches' => !empty($data['personality_matches'])
                ? collect(explode(',', $data['personality_matches']))->map(fn ($s) => trim($s))->filter()->values()->all()
                : null,
            'aptitude_requirements' => [
                'logical' => $data['aptitude_logical'] ?? null,
                'numerical' => $data['aptitude_numerical'] ?? null,
                'verbal' => $data['aptitude_verbal'] ?? null,
            ],
            'is_active' => (bool) ($data['is_active'] ?? true),
        ];
    }
}
