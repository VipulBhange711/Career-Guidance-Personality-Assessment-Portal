@extends('layouts.site', ['title' => 'Assessment Results - Career Guidance Portal'])

@section('content')
    @php
        $isPersonality = ($attempt->assessment?->type ?? '') === 'personality';
        $icon = $isPersonality ? 'fa-brain text-info' : 'fa-chart-line text-primary';
        $score = (float) ($attempt->score ?? 0);
        $level = $score >= 85 ? 'Excellent' : ($score >= 70 ? 'Good' : ($score >= 50 ? 'Average' : 'Needs Improvement'));
    @endphp

    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold">Assessment Results</h1>
                    <p class="lead">Your comprehensive assessment analysis</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas {{ $icon }} fa-5x"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Assessment Summary</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Assessment Type:</strong> {{ ucfirst($attempt->assessment?->type ?? 'N/A') }}</p>
                            <p><strong>Date Completed:</strong> {{ optional($attempt->submitted_at)->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Overall Score:</strong> {{ $score }}%</p>
                            <p><strong>Performance Level:</strong> {{ $level }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header {{ $isPersonality ? 'bg-info' : 'bg-success' }} text-white">
                    <h4 class="mb-0">{{ $isPersonality ? 'Personality Snapshot' : 'Aptitude Snapshot' }}</h4>
                </div>
                <div class="card-body">
                    @if ($isPersonality)
                        <p class="mb-0">This result is based on your responses and helps identify career environments and roles that match your preferences.</p>
                    @else
                        <p class="mb-0">This score reflects your performance in aptitude questions. Use it to understand your strengths and areas to improve.</p>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Your Answers</h4>
                </div>
                <div class="card-body">
                    @foreach ($attempt->answers as $answer)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="fw-semibold">{{ $answer->question?->question_text }}</div>
                            <div class="text-muted small">
                                Selected:
                                @php
                                    $opts = $answer->question?->options ?? [];
                                    $selectedText = $opts[$answer->selected_option] ?? 'N/A';
                                @endphp
                                <span class="fw-semibold text-dark">{{ $selectedText }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Career Recommendations</h4>
                </div>
                <div class="card-body">
                    @if ($recommendations->isEmpty())
                        <p class="text-muted mb-0">No recommendations available yet.</p>
                    @else
                        <div class="row g-3">
                            @foreach ($recommendations as $rec)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="mb-0">{{ $rec->career?->title }}</h6>
                                                <span class="badge bg-warning text-dark">{{ (int) $rec->match_score }}%</span>
                                            </div>
                                            <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($rec->career?->description ?? '', 120) }}</p>
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('careers.index') }}">Explore Careers</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mb-4">
                <div class="btn-group" role="group">
                    <a class="btn btn-primary" href="{{ route('careers.index') }}">
                        <i class="fas fa-lightbulb me-2"></i>View Careers
                    </a>
                    <a class="btn btn-outline-primary" href="{{ route('results.download', $attempt) }}">
                        <i class="fas fa-download me-2"></i>Download Report
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
