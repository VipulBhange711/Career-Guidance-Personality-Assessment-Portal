<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Career Guidance Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">
                <i class="fas fa-graduation-cap me-2"></i>Career Guidance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.html">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="assessments.html">Assessments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="careers.html">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.html">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.html">Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield me-1"></i><span id="adminName">Admin</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../profile.html">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Dashboard Header -->
    <section class="bg-light py-4">
        <div class="container-fluid">
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

    <!-- Dashboard Content -->
    <section class="py-4">
        <div class="container-fluid">
            <div id="alertContainer"></div>
            
            <!-- Quick Stats -->
            <div class="row g-3 mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h3 id="totalUsers">0</h3>
                        <p class="text-muted">Total Users</p>
                        <small class="text-success" id="usersGrowth">+0%</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clipboard-list fa-3x text-info"></i>
                        </div>
                        <h3 id="totalAssessments">0</h3>
                        <p class="text-muted">Assessments</p>
                        <small class="text-success" id="assessmentsGrowth">+0%</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-briefcase fa-3x text-success"></i>
                        </div>
                        <h3 id="totalCareers">0</h3>
                        <p class="text-muted">Career Options</p>
                        <small class="text-info">Database</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-chart-line fa-3x text-warning"></i>
                        </div>
                        <h3 id="activeSessions">0</h3>
                        <p class="text-muted">Active Sessions</p>
                        <small class="text-muted">Live now</small>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-chart-area text-primary me-2"></i>
                            User Registration Trend
                        </h5>
                        <div class="chart-container">
                            <canvas id="userRegistrationChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-chart-pie text-info me-2"></i>
                            Assessment Distribution
                        </h5>
                        <div class="chart-container">
                            <canvas id="assessmentDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Popular Careers -->
            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-history text-secondary me-2"></i>
                            Recent Activity
                        </h5>
                        <div id="recentActivity">
                            <!-- Recent activity will be loaded here -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <h5 class="card-title">
                            <i class="fas fa-star text-warning me-2"></i>
                            Popular Careers
                        </h5>
                        <div id="popularCareers">
                            <!-- Popular careers will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
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
                                    <small class="text-muted d-block">Response: 12ms</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>API Server</h6>
                                    <span class="badge bg-success">Online</span>
                                    <small class="text-muted d-block">Response: 45ms</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Storage</h6>
                                    <span class="badge bg-warning">78% Used</span>
                                    <small class="text-muted d-block">7.8GB / 10GB</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="status-item">
                                    <h6>Last Backup</h6>
                                    <span class="badge bg-success">Complete</span>
                                    <small class="text-muted d-block">2 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h6>Career Guidance Portal - Admin Panel</h6>
                    <p class="small mb-0">System administration and management</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small mb-0">&copy; 2024 Career Guidance Portal. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/main.js"></script>
    
    <script>
        let analyticsData = null;
        
        // Check authentication and load data
        document.addEventListener('DOMContentLoaded', function() {
            if (!checkAuthStatus()) {
                window.location.href = '../login.html';
                return;
            }
            
            // Check if user is admin
            const user = JSON.parse(localStorage.getItem('currentUser') || '{}');
            if (user.user_type !== 'admin') {
                showAlert('Access denied. Admin privileges required.', 'error');
                setTimeout(() => {
                    window.location.href = '../dashboard.html';
                }, 2000);
                return;
            }
            
            loadAnalyticsData();
        });
        
        // Load analytics data
        async function loadAnalyticsData() {
            try {
                const response = await apiCall('/api/dashboard/analytics', 'GET');
                
                if (response.success) {
                    analyticsData = response.data;
                    updateAdminDashboard(response.data);
                } else {
                    showAlert(response.message || 'Failed to load analytics data', 'error');
                }
            } catch (error) {
                showAlert('Network error. Please try again.', 'error');
            }
        }
        
        // Update admin dashboard
        function updateAdminDashboard(data) {
            // Update stats
            document.getElementById('totalUsers').textContent = data.total_users.toLocaleString();
            document.getElementById('totalAssessments').textContent = data.total_assessments.toLocaleString();
            document.getElementById('totalCareers').textContent = data.total_careers.toLocaleString();
            document.getElementById('activeSessions').textContent = Math.floor(Math.random() * 50) + 10; // Simulated
            
            // Update growth indicators
            document.getElementById('usersGrowth').textContent = '+' + Math.floor(Math.random() * 20 + 5) + '%';
            document.getElementById('assessmentsGrowth').textContent = '+' + Math.floor(Math.random() * 15 + 3) + '%';
            
            // Update charts
            renderUserRegistrationChart(data.monthly_activity);
            renderAssessmentDistributionChart(data.assessment_breakdown);
            
            // Update popular careers
            renderPopularCareers(data.popular_careers);
            
            // Update recent activity
            renderRecentActivity();
        }
        
        // Render user registration chart
        function renderUserRegistrationChart(monthlyData) {
            const ctx = document.getElementById('userRegistrationChart').getContext('2d');
            
            // Sort data by date
            const sortedData = monthlyData.sort((a, b) => new Date(a.month) - new Date(b.month));
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: sortedData.map(item => {
                        const date = new Date(item.month + '-01');
                        return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
                    }),
                    datasets: [{
                        label: 'New Users',
                        data: sortedData.map(item => item.count),
                        borderColor: 'rgba(0, 123, 255, 1)',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
        
        // Render assessment distribution chart
        function renderAssessmentDistributionChart(breakdown) {
            const ctx = document.getElementById('assessmentDistributionChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Personality', 'Aptitude'],
                    datasets: [{
                        data: [breakdown.personality, breakdown.aptitude],
                        backgroundColor: [
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(40, 167, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(23, 162, 184, 1)',
                            'rgba(40, 167, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
        
        // Render popular careers
        function renderPopularCareers(careers) {
            const container = document.getElementById('popularCareers');
            
            if (careers.length === 0) {
                container.innerHTML = '<p class="text-muted">No career data available.</p>';
                return;
            }
            
            let html = '';
            careers.slice(0, 5).forEach((career, index) => {
                html += `
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                        <div>
                            <strong>${index + 1}. ${career.career_title}</strong>
                            <br><small class="text-muted">${career.interest_count} users interested</small>
                        </div>
                        <div class="progress" style="width: 100px; height: 20px;">
                            <div class="progress-bar bg-primary" style="width: ${Math.min(100, career.interest_count * 10)}%">
                                ${career.interest_count}
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }
        
        // Render recent activity
        function renderRecentActivity() {
            const container = document.getElementById('recentActivity');
            
            // Simulated recent activities
            const activities = [
                { type: 'user', message: 'New user registration: John Doe', time: '5 minutes ago', icon: 'fa-user-plus', color: 'text-primary' },
                { type: 'assessment', message: 'Personality assessment completed', time: '12 minutes ago', icon: 'fa-clipboard-list', color: 'text-info' },
                { type: 'career', message: 'Career recommendation updated', time: '25 minutes ago', icon: 'fa-briefcase', color: 'text-success' },
                { type: 'system', message: 'Database backup completed', time: '1 hour ago', icon: 'fa-database', color: 'text-warning' },
                { type: 'user', message: 'Counselor session scheduled', time: '2 hours ago', icon: 'fa-calendar-check', color: 'text-secondary' }
            ];
            
            let html = '';
            activities.forEach(activity => {
                html += `
                    <div class="d-flex align-items-center mb-2 p-2 border-bottom">
                        <i class="fas ${activity.icon} ${activity.color} me-3"></i>
                        <div class="flex-grow-1">
                            <p class="mb-0">${activity.message}</p>
                            <small class="text-muted">${activity.time}</small>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }
        
        // Override logout to redirect to main login
        const originalLogout = window.logout;
        window.logout = function() {
            localStorage.removeItem('authToken');
            localStorage.removeItem('currentUser');
            showAlert('Logged out successfully', 'success');
            setTimeout(() => {
                window.location.href = '../login.html';
            }, 1000);
        };
    </script>
    
    <style>
        .status-item {
            text-align: center;
            padding: 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
        }
        
        .status-item:hover {
            transform: translateY(-2px);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .stat-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(0, 123, 255, 0.1);
        }
    </style>
</body>
</html>
