@extends('layouts.site', ['title' => 'Careers - Career Guidance Portal'])

@section('content')
    <!-- Careers Header -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold">Career Explorer</h1>
                    <p class="lead">Discover career opportunities that match your skills, interests, and personality</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-briefcase fa-5x text-primary"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <form method="GET" action="{{ route('careers.index') }}" id="careersFilterForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="q" id="searchInput" value="{{ $filters['q'] ?? '' }}"
                                   placeholder="Search careers by title, keywords, or skills...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category" id="categoryFilter">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ ($filters['category'] ?? '') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="education_level" id="educationFilter">
                            <option value="">All Education Levels</option>
                            @foreach ($educationLevels as $levelValue => $levelLabel)
                                <option value="{{ $levelValue }}" {{ ($filters['education_level'] ?? '') === $levelValue ? 'selected' : '' }}>{{ $levelLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="text-muted">Quick filters:</span>
                            @foreach ($quickFilters as $qf)
                                <button class="btn btn-sm btn-outline-primary" type="submit" name="category" value="{{ $qf['value'] }}">
                                    <i class="fas {{ $qf['icon'] }} me-1"></i>{{ $qf['label'] }}
                                </button>
                            @endforeach
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('careers.index') }}">
                                <i class="fas fa-times me-1"></i>Clear Filters
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Careers -->
    <section class="py-5">
        <div class="container">
            @auth
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="mb-3">
                            <i class="fas fa-star text-warning me-2"></i>
                            Recommended for You
                            <small class="text-muted">Based on your assessment results</small>
                        </h2>
                    </div>
                </div>

                <div class="row g-4 mb-5" id="recommendedCareers">
                    @forelse ($recommended as $rec)
                        @php($career = $rec->career)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $career->title }}</h5>
                                        <span class="badge bg-warning text-dark">{{ (int) $rec->match_score }}%</span>
                                    </div>
                                    <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($career->description, 140) }}</p>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100"
                                                data-bs-toggle="modal" data-bs-target="#careerModal"
                                                data-career='@json($career)'>
                                            View Details
                                        </button>
                                        <form method="POST" action="{{ route('careers.save', $career) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" {{ in_array($career->id, $savedCareerIds, true) ? 'disabled' : '' }}>
                                                <i class="fas fa-bookmark me-1"></i>{{ in_array($career->id, $savedCareerIds, true) ? 'Saved' : 'Save' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted mb-0">No recommendations yet. Complete an assessment to get personalized recommendations.</p>
                        </div>
                    @endforelse
                </div>
            @endauth

            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="mb-3">
                        <i class="fas fa-th-large text-primary me-2"></i>
                        Explore All Careers
                        <small class="text-muted">Browse our complete career database</small>
                    </h2>
                </div>
            </div>

            <div class="row g-4" id="allCareers">
                @forelse ($careers as $career)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $career->title }}</h5>
                                    @if($career->category)
                                        <span class="badge bg-light text-dark">{{ ucfirst($career->category) }}</span>
                                    @endif
                                </div>
                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($career->description, 140) }}</p>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100"
                                            data-bs-toggle="modal" data-bs-target="#careerModal"
                                            data-career='@json($career)'>
                                        View Details
                                    </button>
                                    @auth
                                        <form method="POST" action="{{ route('careers.save', $career) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" {{ in_array($career->id, $savedCareerIds, true) ? 'disabled' : '' }}>
                                                <i class="fas fa-bookmark me-1"></i>{{ in_array($career->id, $savedCareerIds, true) ? 'Saved' : 'Save' }}
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No careers found for the selected filters.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $careers->withQueryString()->links() }}
            </div>
        </div>
    </section>

    <!-- Career Details Modal -->
    <div class="modal fade" id="careerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="careerModalTitle">Career Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="careerModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const form = document.getElementById('careersFilterForm');
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const educationFilter = document.getElementById('educationFilter');

            let debounceTimer = null;
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => form.submit(), 300);
                });
            }
            if (categoryFilter) categoryFilter.addEventListener('change', () => form.submit());
            if (educationFilter) educationFilter.addEventListener('change', () => form.submit());

            const careerModal = document.getElementById('careerModal');
            if (!careerModal) return;

            careerModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const careerJson = button.getAttribute('data-career');
                const career = JSON.parse(careerJson);

                document.getElementById('careerModalTitle').textContent = career.title;
                const skills = Array.isArray(career.required_skills) ? career.required_skills : [];
                const personality = Array.isArray(career.personality_matches) ? career.personality_matches : [];

                document.getElementById('careerModalBody').innerHTML = `
                    <p class="text-muted">${career.description ?? ''}</p>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6><i class="fas fa-graduation-cap me-2 text-primary"></i>Education Requirements</h6>
                            <p class="mb-0">${career.education_requirements ?? '-'}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-money-bill-wave me-2 text-success"></i>Salary Range</h6>
                            <p class="mb-0">${career.salary_range ?? '-'}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-chart-line me-2 text-info"></i>Job Outlook</h6>
                            <p class="mb-0">${career.job_outlook ?? '-'}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-building me-2 text-secondary"></i>Work Environment</h6>
                            <p class="mb-0">${career.work_environment ?? '-'}</p>
                        </div>
                        <div class="col-12">
                            <h6><i class="fas fa-tools me-2 text-warning"></i>Required Skills</h6>
                            <div class="d-flex flex-wrap gap-2">
                                ${skills.length ? skills.map(s => `<span class="badge bg-light text-dark">${s}</span>`).join('') : '<span class="text-muted">-</span>'}
                            </div>
                        </div>
                        <div class="col-12">
                            <h6><i class="fas fa-user-check me-2 text-primary"></i>Personality Matches</h6>
                            <div class="d-flex flex-wrap gap-2">
                                ${personality.length ? personality.map(s => `<span class="badge bg-primary">${s}</span>`).join('') : '<span class="text-muted">-</span>'}
                            </div>
                        </div>
                    </div>
                `;
            });
        })();
    </script>
@endpush
