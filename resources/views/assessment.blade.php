@extends('layouts.site', ['title' => 'Assessments - Career Guidance Portal'])

@section('content')
    <!-- Assessment Header -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold">Career Assessments</h1>
                    <p class="lead">Discover your strengths and find the perfect career path through our comprehensive assessments</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-clipboard-list fa-5x text-primary"></i>
                </div>
            </div>
        </div>
    </section>

    @if (isset($assessments))
        <!-- Assessment Selection -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4" id="assessmentSelection">
                    @foreach ($assessments as $assessment)
                        @php
                            $isPersonality = $assessment->type === 'personality';
                            $btnClass = $isPersonality ? 'info' : 'success';
                            $iconClass = $isPersonality ? 'fa-brain text-info' : 'fa-lightbulb text-success';
                            $timeText = $isPersonality ? '15-20 mins' : '25-30 mins';
                            $questionsText = $assessment->questions_count ? ($assessment->questions_count.' questions') : 'Questions';
                            $reportText = $isPersonality ? 'Detailed report' : 'Score analysis';
                        @endphp

                        <div class="col-md-6">
                            <div class="card h-100 assessment-card">
                                <div class="card-body text-center p-4">
                                    <div class="assessment-icon mb-3">
                                        <i class="fas {{ $iconClass }} fa-4x"></i>
                                    </div>
                                    <h3 class="card-title">{{ $assessment->title }}</h3>
                                    <p class="card-text">{{ $assessment->description }}</p>

                                    <div class="assessment-details mb-3">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <i class="fas fa-clock text-muted"></i>
                                                <p class="small mb-0">{{ $timeText }}</p>
                                            </div>
                                            <div class="col-4">
                                                <i class="fas fa-question-circle text-muted"></i>
                                                <p class="small mb-0">{{ $questionsText }}</p>
                                            </div>
                                            <div class="col-4">
                                                <i class="fas fa-chart-bar text-muted"></i>
                                                <p class="small mb-0">{{ $reportText }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="btn btn-{{ $btnClass }} btn-lg w-100" href="{{ route('assessment.show', $assessment) }}">
                                        <i class="fas fa-play me-2"></i>Start Assessment
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Recent Results Section -->
        <section class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">Your Recent Assessment Results</h2>
                <div class="row" id="recentResults">
                    @forelse($recentAttempts as $attempt)
                        @php
                            $isPersonality = $attempt->assessment?->type === 'personality';
                            $typeIcon = $isPersonality ? 'fa-brain text-info' : 'fa-lightbulb text-success';
                            $typeColor = $isPersonality ? 'info' : 'success';
                        @endphp
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <i class="fas {{ $typeIcon }} fa-2x"></i>
                                    </div>
                                    <h6 class="card-title text-center">{{ $attempt->assessment?->title ?? 'Assessment' }}</h6>
                                    <p class="card-text small text-center">
                                        <i class="fas fa-calendar me-1"></i>{{ optional($attempt->submitted_at)->format('d M Y') }}
                                    </p>
                                    <div class="text-center">
                                        <a href="{{ route('results.show', $attempt) }}" class="btn btn-sm btn-outline-{{ $typeColor }}">
                                            View Results
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No assessments completed yet. Start your first assessment above!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    @if (isset($assessment))
        <section class="py-5">
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $assessment->title }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Before you begin:</h5>
                        <ul>
                            <li>Find a quiet place where you won't be disturbed</li>
                            <li>Answer honestly - there are no right or wrong answers</li>
                            <li>Work at your own pace, but complete in one session</li>
                            <li>Read each question carefully before answering</li>
                            <li>Your results will help us provide better career recommendations</li>
                        </ul>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Questions:</strong> {{ $assessment->questions->count() }}
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('assessment.submit', $assessment) }}" id="assessmentForm">
                    @csrf

                    <div class="assessment-progress mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span id="progressText">0% Complete</span>
                            <span id="questionCounter">Question 1 of {{ $assessment->questions->count() }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar progress-bar-animated" id="assessmentProgress"
                                 role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div id="questionContainer">
                        @foreach ($assessment->questions as $index => $question)
                            <div class="question-card fade-in assessment-question" data-index="{{ $index }}" style="{{ $index === 0 ? '' : 'display:none;' }}">
                                <h4>Question {{ $index + 1 }} of {{ $assessment->questions->count() }}</h4>
                                <p class="lead">{{ $question->question_text }}</p>

                                <div class="answers-container">
                                    @foreach (($question->options ?? []) as $optIndex => $optionText)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="answers[{{ $question->id }}]"
                                                   id="q{{ $question->id }}_opt{{ $optIndex }}"
                                                   value="{{ $optIndex }}"
                                                   {{ old("answers.{$question->id}") == $optIndex ? 'checked' : '' }}
                                                   required>
                                            <label class="form-check-label" for="q{{ $question->id }}_opt{{ $optIndex }}">
                                                {{ $optionText }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-secondary" id="prevQuestion" type="button" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i>Previous
                        </button>
                        <button class="btn btn-primary" id="nextQuestion" type="button">
                            Next<i class="fas fa-arrow-right ms-2"></i>
                        </button>
                        <button class="btn btn-success" id="submitAssessment" type="submit" style="display: none;">
                            <i class="fas fa-check me-2"></i>Submit Assessment
                        </button>
                    </div>
                </form>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    @if (isset($assessment))
        <script>
            (function () {
                const questions = Array.from(document.querySelectorAll('.assessment-question'));
                const total = questions.length;
                let current = 0;

                const prevBtn = document.getElementById('prevQuestion');
                const nextBtn = document.getElementById('nextQuestion');
                const submitBtn = document.getElementById('submitAssessment');
                const progressBar = document.getElementById('assessmentProgress');
                const progressText = document.getElementById('progressText');
                const questionCounter = document.getElementById('questionCounter');

                function show(index) {
                    questions.forEach((el, i) => el.style.display = i === index ? '' : 'none');
                    current = index;

                    const percent = total > 1 ? Math.round((index / (total - 1)) * 100) : 100;
                    progressBar.style.width = percent + '%';
                    progressBar.setAttribute('aria-valuenow', String(percent));
                    progressText.textContent = percent + '% Complete';
                    questionCounter.textContent = 'Question ' + (index + 1) + ' of ' + total;

                    prevBtn.style.display = index === 0 ? 'none' : '';
                    const isLast = index === total - 1;
                    nextBtn.style.display = isLast ? 'none' : '';
                    submitBtn.style.display = isLast ? '' : 'none';
                }

                function currentAnswered() {
                    const currentEl = questions[current];
                    const requiredInput = currentEl.querySelector('input[type="radio"][required]');
                    if (!requiredInput) return true;
                    const name = requiredInput.getAttribute('name');
                    return !!document.querySelector('input[name="' + name.replace(/"/g, '\\"') + '"]:checked');
                }

                prevBtn.addEventListener('click', function () {
                    if (current > 0) show(current - 1);
                });

                nextBtn.addEventListener('click', function () {
                    if (!currentAnswered()) {
                        const currentEl = questions[current];
                        currentEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        return;
                    }
                    if (current < total - 1) show(current + 1);
                });

                show(0);
            })();
        </script>
    @endif
@endpush
