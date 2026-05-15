<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Career Guidance Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-graduation-cap me-2"></i>Career Guidance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="assessment.html">Assessments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="careers.html">Careers</a>
                    </li>
                    <li class="nav-item dropdown" id="userDropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><span id="userName">User</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="dashboard.html">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                            <h4 id="profileName">Loading...</h4>
                            <p class="text-muted" id="profileEmail">Loading...</p>
                            <span class="badge bg-primary" id="profileType">Student</span>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Quick Actions</h6>
                            <div class="d-grid gap-2">
                                <a href="assessment.html" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-clipboard-list me-2"></i>Take Assessment
                                </a>
                                <a href="dashboard.html" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-chart-line me-2"></i>View Dashboard
                                </a>
                                <a href="careers.html" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-briefcase me-2"></i>Browse Careers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Content -->
                <div class="col-md-8">
                    <div class="profile-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Personal Information</h4>
                            <button class="btn btn-primary" onclick="toggleEditMode()">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </button>
                        </div>
                        
                        <div id="alertContainer"></div>
                        
                        <form id="profileForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" disabled>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" disabled>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" disabled></textarea>
                            </div>
                        </form>
                    </div>
                    
                    <div class="profile-section">
                        <h4 class="mb-4">Education Information</h4>
                        
                        <form id="educationForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="education_level" class="form-label">Education Level</label>
                                    <select class="form-select" id="education_level" name="education_level" disabled>
                                        <option value="">Select Education Level</option>
                                        <option value="high_school">High School</option>
                                        <option value="undergraduate">Undergraduate</option>
                                        <option value="graduate">Graduate</option>
                                        <option value="postgraduate">Postgraduate</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="current_education" class="form-label">Current Education/Field</label>
                                    <input type="text" class="form-control" id="current_education" name="current_education" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="profile-section">
                        <h4 class="mb-4">Career Preferences</h4>
                        
                        <form id="careerForm">
                            <div class="mb-3">
                                <label for="interests" class="form-label">Interests & Hobbies</label>
                                <textarea class="form-control" id="interests" name="interests" rows="3" 
                                          placeholder="Tell us about your interests, hobbies, and what you enjoy doing..." disabled></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="career_goals" class="form-label">Career Goals</label>
                                <textarea class="form-control" id="career_goals" name="career_goals" rows="3" 
                                          placeholder="What are your career aspirations and long-term goals?" disabled></textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary" id="cancelBtn" onclick="cancelEdit()" style="display: none;">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveBtn" style="display: none;">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="profile-section">
                        <h4 class="mb-4">Account Settings</h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Change Password</h6>
                                <button class="btn btn-outline-warning" onclick="showPasswordModal()">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </button>
                            </div>
                            <div class="col-md-6">
                                <h6>Privacy Settings</h6>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-shield-alt me-2"></i>Privacy Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Password Change Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required minlength="8">
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="changePassword()">Change Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Career Guidance Portal</h5>
                    <p>Empowering students to make informed career decisions.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 Career Guidance Portal. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    
    <script>
        let isEditMode = false;
        
        // Check authentication and load profile
        document.addEventListener('DOMContentLoaded', function() {
            if (!checkAuthStatus()) {
                window.location.href = 'login.html';
                return;
            }
            
            loadProfileData();
            setupEventListeners();
        });
        
        // Setup event listeners
        function setupEventListeners() {
            // Profile form submission
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                e.preventDefault();
                if (isEditMode) {
                    saveProfile();
                }
            });
            
            // Password form validation
            document.getElementById('confirm_new_password').addEventListener('input', function() {
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = this.value;
                
                if (confirmPassword && newPassword !== confirmPassword) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }
        
        // Load profile data
        async function loadProfileData() {
            try {
                const response = await apiCall('/api/profile/data', 'GET');
                
                if (response.success) {
                    const user = response.user;
                    const profile = response.profile;
                    
                    // Update profile header
                    document.getElementById('profileName').textContent = `${user.first_name} ${user.last_name}`;
                    document.getElementById('profileEmail').textContent = user.email;
                    document.getElementById('profileType').textContent = user.user_type.charAt(0).toUpperCase() + user.user_type.slice(1);
                    
                    // Fill user information
                    document.getElementById('first_name').value = user.first_name || '';
                    document.getElementById('last_name').value = user.last_name || '';
                    
                    // Fill profile information
                    if (profile) {
                        document.getElementById('date_of_birth').value = profile.date_of_birth || '';
                        document.getElementById('gender').value = profile.gender || '';
                        document.getElementById('phone').value = profile.phone || '';
                        document.getElementById('address').value = profile.address || '';
                        document.getElementById('education_level').value = profile.education_level || '';
                        document.getElementById('current_education').value = profile.current_education || '';
                        document.getElementById('interests').value = profile.interests || '';
                        document.getElementById('career_goals').value = profile.career_goals || '';
                    }
                } else {
                    showAlert(response.message || 'Failed to load profile data', 'error');
                }
            } catch (error) {
                showAlert('Network error. Please try again.', 'error');
            }
        }
        
        // Toggle edit mode
        function toggleEditMode() {
            isEditMode = !isEditMode;
            
            const formFields = document.querySelectorAll('#profileForm input, #profileForm select, #profileForm textarea, #educationForm input, #educationForm select, #careerForm textarea');
            const saveBtn = document.getElementById('saveBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const editBtn = document.querySelector('button[onclick="toggleEditMode()"]');
            
            formFields.forEach(field => {
                field.disabled = !isEditMode;
            });
            
            if (isEditMode) {
                saveBtn.style.display = 'block';
                cancelBtn.style.display = 'block';
                editBtn.style.display = 'none';
            } else {
                saveBtn.style.display = 'none';
                cancelBtn.style.display = 'none';
                editBtn.style.display = 'block';
            }
        }
        
        // Cancel edit
        function cancelEdit() {
            isEditMode = false;
            toggleEditMode();
            loadProfileData(); // Reload original data
        }
        
        // Save profile
        async function saveProfile() {
            const formData = new FormData(document.getElementById('profileForm'));
            const educationData = new FormData(document.getElementById('educationForm'));
            const careerData = new FormData(document.getElementById('careerForm'));
            
            const profileData = {
                date_of_birth: formData.get('date_of_birth'),
                gender: formData.get('gender'),
                phone: formData.get('phone'),
                address: formData.get('address'),
                education_level: educationData.get('education_level'),
                current_education: educationData.get('current_education'),
                interests: careerData.get('interests'),
                career_goals: careerData.get('career_goals')
            };
            
            try {
                const response = await apiCall('/api/profile/update', 'POST', profileData);
                
                if (response.success) {
                    showAlert('Profile updated successfully!', 'success');
                    isEditMode = false;
                    toggleEditMode();
                } else {
                    showAlert(response.message || 'Failed to update profile', 'error');
                }
            } catch (error) {
                showAlert('Network error. Please try again.', 'error');
            }
        }
        
        // Show password modal
        function showPasswordModal() {
            const modal = new bootstrap.Modal(document.getElementById('passwordModal'));
            modal.show();
        }
        
        // Change password
        async function changePassword() {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_new_password').value;
            
            if (!currentPassword || !newPassword || !confirmPassword) {
                showAlert('All fields are required', 'error');
                return;
            }
            
            if (newPassword.length < 8) {
                showAlert('New password must be at least 8 characters long', 'error');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                showAlert('New passwords do not match', 'error');
                return;
            }
            
            try {
                const response = await apiCall('/api/auth/change-password', 'POST', {
                    current_password: currentPassword,
                    new_password: newPassword
                });
                
                if (response.success) {
                    showAlert('Password changed successfully!', 'success');
                    
                    // Close modal and reset form
                    const modal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
                    modal.hide();
                    document.getElementById('passwordForm').reset();
                } else {
                    showAlert(response.message || 'Failed to change password', 'error');
                }
            } catch (error) {
                showAlert('Network error. Please try again.', 'error');
            }
        }
    </script>
</body>
</html>
