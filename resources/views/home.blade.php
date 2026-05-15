@extends('layouts.site', ['title' => 'Career Guidance & Personality Assessment Portal'])

@section('content')

    <!-- Hero Section -->
    <section class="hero-section text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Discover Your Perfect Career Path</h1>
            <p class="lead mb-4">Take our comprehensive personality and aptitude assessments to find the career that best suits your unique traits and skills</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-md-2">
                            <i class="fas fa-user-plus me-2"></i>Get Started
                        </a>
                        <a href="{{ route('assessment.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-clipboard-list me-2"></i>Take Assessment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-brain fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Personality Assessment</h5>
                            <p class="card-text">Comprehensive personality tests to understand your traits, strengths, and preferences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-chart-line fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Career Recommendations</h5>
                            <p class="card-text">Personalized career suggestions based on your assessment results and interests.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-chart-pie fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title">Visual Analytics</h5>
                            <p class="card-text">Interactive dashboards and charts to visualize your assessment results.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Impact</h2>
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="stat-item">
                        <h3 class="text-primary fw-bold">5000+</h3>
                        <p>Students Assessed</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <h3 class="text-success fw-bold">95%</h3>
                        <p>Satisfaction Rate</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <h3 class="text-info fw-bold">200+</h3>
                        <p>Career Paths</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <h3 class="text-warning fw-bold">50+</h3>
                        <p>Expert Counselors</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
