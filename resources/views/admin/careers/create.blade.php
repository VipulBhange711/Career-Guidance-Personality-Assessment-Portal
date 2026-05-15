@extends('layouts.site', ['title' => 'Add Career - Admin'])

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Add Career</h2>
                <a class="btn btn-outline-secondary" href="{{ route('admin.careers.index') }}">Back</a>
            </div>

            <div class="profile-section">
                <form method="POST" action="{{ route('admin.careers.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category</label>
                            <input class="form-control" id="category" name="category" value="{{ old('category') }}" placeholder="technology, business, ...">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="required_skills">Required Skills (comma-separated)</label>
                        <input class="form-control" id="required_skills" name="required_skills" value="{{ old('required_skills') }}" placeholder="Communication, Problem-solving, ...">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="education_requirements">Education Requirements</label>
                            <input class="form-control" id="education_requirements" name="education_requirements" value="{{ old('education_requirements') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="education_level">Education Level</label>
                            <select class="form-select" id="education_level" name="education_level">
                                <option value="">Select</option>
                                @foreach($educationLevels as $value => $label)
                                    <option value="{{ $value }}" {{ old('education_level') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="salary_range">Salary Range</label>
                            <input class="form-control" id="salary_range" name="salary_range" value="{{ old('salary_range') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="job_outlook">Job Outlook</label>
                            <input class="form-control" id="job_outlook" name="job_outlook" value="{{ old('job_outlook') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="work_environment">Work Environment</label>
                            <input class="form-control" id="work_environment" name="work_environment" value="{{ old('work_environment') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="personality_matches">Personality Matches (comma-separated)</label>
                        <input class="form-control" id="personality_matches" name="personality_matches" value="{{ old('personality_matches') }}" placeholder="Analytical, Creative, ...">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="aptitude_logical">Aptitude: Logical</label>
                            <input class="form-control" id="aptitude_logical" name="aptitude_logical" type="number" min="0" max="100" value="{{ old('aptitude_logical') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="aptitude_numerical">Aptitude: Numerical</label>
                            <input class="form-control" id="aptitude_numerical" name="aptitude_numerical" type="number" min="0" max="100" value="{{ old('aptitude_numerical') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="aptitude_verbal">Aptitude: Verbal</label>
                            <input class="form-control" id="aptitude_verbal" name="aptitude_verbal" type="number" min="0" max="100" value="{{ old('aptitude_verbal') }}">
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
