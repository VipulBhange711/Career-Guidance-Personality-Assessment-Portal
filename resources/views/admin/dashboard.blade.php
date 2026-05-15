@extends('layouts.site', ['title' => 'Admin Dashboard - Career Guidance Portal'])

@section('content')
    <section class="bg-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold">Admin Dashboard</h1>
                    <p class="lead">System overview and management controls</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-cogs fa-4x text-primary"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            <div class="row g-3 mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h3>{{ $stats['users'] }}</h3>
                        <p class="text-muted">Total Users</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clipboard-list fa-3x text-info"></i>
                        </div>
                        <h3>{{ $stats['assessments'] }}</h3>
                        <p class="text-muted">Assessments</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-briefcase fa-3x text-success"></i>
                        </div>
                        <h3>{{ $stats['careers'] }}</h3>
                        <p class="text-muted">Career Options</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-user-shield fa-3x text-warning"></i>
                        </div>
                        <h3>{{ $stats['admins'] }}</h3>
                        <p class="text-muted">Admins</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-12">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-user-clock text-secondary me-2"></i>
                            Latest Users
                        </h5>
                        <div class="d-flex gap-2 mb-3">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.careers.index') }}"><i class="fas fa-briefcase me-1"></i>Manage Careers</a>
                            <a class="btn btn-sm btn-info text-white" href="{{ route('admin.questions.index') }}"><i class="fas fa-question-circle me-1"></i>Manage Questions</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($latestUsers as $u)
                                    <tr>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td><span class="badge bg-primary">{{ $u->role }}</span></td>
                                        <td class="text-muted">{{ $u->created_at?->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-server text-success me-2"></i>
                            System Status
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Database</h6>
                                    <span class="badge bg-success">Online</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Sessions</h6>
                                    <span class="badge bg-success">Enabled</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Queues</h6>
                                    <span class="badge bg-success">Configured</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Mail</h6>
                                    <span class="badge bg-warning text-dark">Log</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
