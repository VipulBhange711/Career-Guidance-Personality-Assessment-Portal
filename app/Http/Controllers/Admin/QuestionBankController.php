<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionBankController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'assessment_id' => $request->query('assessment_id'),
            'q' => trim((string) $request->query('q', '')),
        ];

        $query = Question::query()->with('assessment')->orderBy('assessment_id')->orderBy('display_order');

        if (!empty($filters['assessment_id'])) {
            $query->where('assessment_id', $filters['assessment_id']);
        }
        if ($filters['q'] !== '') {
            $q = $filters['q'];
            $query->where(function ($sub) use ($q) {
                $sub->where('question_text', 'like', "%{$q}%")->orWhere('category', 'like', "%{$q}%");
            });
        }

        $questions = $query->paginate(20);
        $assessments = Assessment::query()->orderBy('title')->get();

        return view('admin.questions.index', compact('questions', 'assessments', 'filters'));
    }

    public function create(Request $request)
    {
        $assessments = Assessment::query()->orderBy('title')->get();
        $selectedAssessmentId = $request->query('assessment_id');
        return view('admin.questions.create', compact('assessments', 'selectedAssessmentId'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateQuestion($request);
        Question::create($validated);

        return redirect()
            ->route('admin.questions.index', ['assessment_id' => $validated['assessment_id']])
            ->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        $assessments = Assessment::query()->orderBy('title')->get();
        return view('admin.questions.edit', compact('question', 'assessments'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $this->validateQuestion($request);
        $question->update($validated);

        return redirect()
            ->route('admin.questions.index', ['assessment_id' => $validated['assessment_id']])
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $assessmentId = $question->assessment_id;
        $question->delete();

        return redirect()
            ->route('admin.questions.index', ['assessment_id' => $assessmentId])
            ->with('success', 'Question deleted successfully.');
    }

    private function validateQuestion(Request $request): array
    {
        $data = $request->validate([
            'assessment_id' => ['required', 'exists:assessments,id'],
            'question_text' => ['required', 'string'],
            'question_type' => ['required', 'in:multiple_choice,likert_scale'],
            'category' => ['nullable', 'string', 'max:255'],
            'options_raw' => ['required', 'string'],
            'correct_option' => ['nullable', 'integer', 'min:0'],
            'display_order' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ]);

        $options = collect(preg_split("/\r\n|\n|\r/", $data['options_raw']))
            ->map(fn ($s) => trim((string) $s))
            ->filter()
            ->values()
            ->all();

        if (count($options) < 2) {
            throw ValidationException::withMessages([
                'options_raw' => ['Please provide at least 2 options.'],
            ]);
        }

        $correctOption = $data['question_type'] === 'multiple_choice'
            ? ($data['correct_option'] ?? null)
            : null;

        if ($correctOption !== null && $correctOption >= count($options)) {
            throw ValidationException::withMessages([
                'correct_option' => ['Correct option index is out of range.'],
            ]);
        }

        return [
            'assessment_id' => (int) $data['assessment_id'],
            'question_text' => $data['question_text'],
            'question_type' => $data['question_type'],
            'category' => $data['category'] ?? null,
            'options' => $options,
            'correct_option' => $correctOption,
            'display_order' => (int) ($data['display_order'] ?? 1),
        ];
    }
}
