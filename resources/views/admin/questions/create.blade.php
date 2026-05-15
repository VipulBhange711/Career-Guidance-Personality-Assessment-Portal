@extends('layouts.site', ['title' => 'Add Question - Admin'])

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Add Question</h2>
                <a class="btn btn-outline-secondary" href="{{ route('admin.questions.index', ['assessment_id' => $selectedAssessmentId]) }}">Back</a>
            </div>

            <div class="profile-section">
                <form method="POST" action="{{ route('admin.questions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="assessment_id">Assessment</label>
                        <select class="form-select" id="assessment_id" name="assessment_id" required>
                            @foreach ($assessments as $a)
                                <option value="{{ $a->id }}" {{ (string) old('assessment_id', $selectedAssessmentId) === (string) $a->id ? 'selected' : '' }}>
                                    {{ $a->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="question_text">Question</label>
                        <textarea class="form-control" id="question_text" name="question_text" rows="3" required>{{ old('question_text') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="question_type">Type</label>
                            <select class="form-select" id="question_type" name="question_type" required>
                                <option value="multiple_choice" {{ old('question_type') === 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                                <option value="likert_scale" {{ old('question_type') === 'likert_scale' ? 'selected' : '' }}>Likert Scale</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="category">Category</label>
                            <input class="form-control" id="category" name="category" value="{{ old('category') }}" placeholder="Analytical, Social, Numerical...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="display_order">Display Order</label>
                            <input class="form-control" id="display_order" name="display_order" type="number" min="1" value="{{ old('display_order', 1) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="options_raw">Options (one per line)</label>
                        <textarea class="form-control" id="options_raw" name="options_raw" rows="6" required>{{ old('options_raw') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="correct_option">Correct Option Index (0-based, only for Multiple Choice)</label>
                        <input class="form-control" id="correct_option" name="correct_option" type="number" min="0" value="{{ old('correct_option') }}">
                    </div>

                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
