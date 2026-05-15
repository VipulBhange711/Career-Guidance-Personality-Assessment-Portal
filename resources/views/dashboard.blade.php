@extends('layouts.site', ['title' => 'Dashboard - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="dashboard-hero">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="greeting">
                                    <span id="greetingText">Hello</span>, <span id="userFirstName">{{ \Illuminate\Support\Str::of(auth()->user()->name)->explode(' ')->first() }}</span>!
                                </div>
                                <p class="lead mb-3">Welcome to your personalized career journey dashboard</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="badge bg-light text-dark px-3 py-2">
                                        <i class="fas fa-calendar-day me-2"></i>
                                        <span id="currentDate"></span>
                                    </span>
                                    <span class="badge bg-light text-dark px-3 py-2">
                                        <i class="fas fa-clock me-2"></i>
                                        <span id="liveClock"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <div class="progress-ring mx-auto">
                                    <svg width="150" height="150">
                                        <circle class="progress-ring-circle progress-ring-circle-bg" cx="75" cy="75" r="65"></circle>
                                        <circle class="progress-ring-circle progress-ring-circle-progress"
                                                cx="75" cy="75" r="65"
                                                stroke-dasharray="408.4"
                                                stroke-dashoffset="408.4"
                                                id="progressCircle"></circle>
                                    </svg>
                                    <div class="progress-text">
                                        <span id="completionRate">{{ $profileCompletion }}</span>%
                                    </div>
                                </div>
                                <p class="mt-2 mb-0"><small>Profile Completion</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="counter">{{ $stats['assessments_completed'] }}</div>
                        <p class="text-muted">Assessments Done</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon pink">
                            <i class="fas fa-bookmark"></i>
                        </div>
                        <div class="counter">{{ $stats['saved_careers'] }}</div>
                        <p class="text-muted">Dream Careers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="counter">{{ $stats['recommendations'] }}</div>
                        <p class="text-muted">Recommendations</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            Your Recent Scores
                        </h5>
                        <div style="height: 300px;">
                            <canvas id="scoresChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-lightbulb text-success me-2"></i>
                            Top Recommendations
                        </h5>
                        <div style="height: 300px;">
                            <canvas id="recommendationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="glass-card p-4">
                        <h5 class="mb-3"><i class="fas fa-history text-secondary me-2"></i>Recent Assessments</h5>
                        @forelse ($latestAttempts as $attempt)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ $attempt->assessment?->title ?? 'Assessment' }}</div>
                                    <div class="text-muted small">
                                        <i class="fas fa-calendar me-1"></i>{{ optional($attempt->submitted_at)->format('d M Y, h:i A') }}
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">{{ $attempt->score ?? 0 }}%</div>
                                    <a class="btn btn-sm btn-outline-primary mt-1" href="{{ route('results.show', $attempt) }}">View</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No assessments completed yet.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="glass-card p-4">
                        <h5 class="mb-3"><i class="fas fa-star text-warning me-2"></i>Recommended Careers</h5>
                        @forelse ($recommendations as $rec)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ $rec->career?->title ?? 'Career' }}</div>
                                    <div class="text-muted small">{{ \Illuminate\Support\Str::limit($rec->career?->description ?? '', 70) }}</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-warning text-dark">{{ (int) $rec->match_score }}%</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No recommendations yet. Complete an assessment to generate recommendations.</p>
                        @endforelse
                        <div class="mt-3">
                            <a class="btn btn-primary btn-sm" href="{{ route('careers.index') }}">
                                <i class="fas fa-briefcase me-2"></i>Explore Careers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function () {
            const now = new Date();
            document.getElementById('currentDate').textContent = now.toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });

            function updateClock() {
                document.getElementById('liveClock').textContent = new Date().toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            }
            updateClock();
            setInterval(updateClock, 1000);

            const hour = new Date().getHours();
            const greeting = hour < 12 ? 'Good Morning' : (hour < 18 ? 'Good Afternoon' : 'Good Evening');
            document.getElementById('greetingText').textContent = greeting;

            const completionRate = Number(document.getElementById('completionRate').textContent || '0');
            const circle = document.getElementById('progressCircle');
            const circumference = 408.4;
            circle.style.strokeDashoffset = String(circumference - (completionRate / 100) * circumference);

            const scoresData = @json($chartScores);
            const ctxScores = document.getElementById('scoresChart');
            if (ctxScores) {
                new Chart(ctxScores, {
                    type: 'line',
                    data: {
                        labels: scoresData.labels,
                        datasets: [{
                            label: 'Score (%)',
                            data: scoresData.values,
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13,110,253,0.15)',
                            tension: 0.35,
                            fill: true
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, max: 100 } } }
                });
            }

            const recData = @json($chartRecommendations);
            const ctxRec = document.getElementById('recommendationsChart');
            if (ctxRec) {
                new Chart(ctxRec, {
                    type: 'bar',
                    data: {
                        labels: recData.labels,
                        datasets: [{
                            label: 'Match (%)',
                            data: recData.values,
                            backgroundColor: 'rgba(25,135,84,0.25)',
                            borderColor: '#198754',
                            borderWidth: 1
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, max: 100 } } }
                });
            }
        })();
    </script>
@endpush
