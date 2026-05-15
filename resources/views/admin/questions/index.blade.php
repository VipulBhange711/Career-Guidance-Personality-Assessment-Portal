@extends('layouts.site', ['title' => 'Question Bank - Admin'])

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0"><i class="fas fa-question-circle me-2 text-primary"></i>Question Bank</h2>
                <a class="btn btn-primary" href="{{ route('admin.questions.create', ['assessment_id' => $filters['assessment_id'] ?? null]) }}">
                    <i class="fas fa-plus me-2"></i>Add Question
                </a>
            </div>

            <div class="profile-section mb-3">
                <form method="GET" action="{{ route('admin.questions.index') }}">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select class="form-select" name="assessment_id">
                                <option value="">All Assessments</option>
                                @foreach ($assessments as $a)
                                    <option value="{{ $a->id }}" {{ (string) ($filters['assessment_id'] ?? '') === (string) $a->id ? 'selected' : '' }}>
                                        {{ $a->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search by question text or category...">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Assessment</th>
                            <th>Question</th>
                            <th>Type</th>
                            <th>Order</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questions as $q)
                            <tr>
                                <td class="text-muted">{{ $q->assessment?->title ?? '-' }}</td>
                                <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($q->question_text, 80) }}</td>
                                <td><span class="badge bg-light text-dark">{{ str_replace('_', ' ', $q->question_type) }}</span></td>
                                <td>{{ $q->display_order }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.questions.edit', $q) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.questions.destroy', $q) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this question?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $questions->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
