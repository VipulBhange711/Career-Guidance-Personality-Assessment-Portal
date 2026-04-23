// Career Guidance Portal Main JavaScript - Frontend Only Version

// Global variables
let currentUser = null;
let assessmentSession = null;

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    // Load frontend API
    const script = document.createElement('script');
    script.src = 'assets/js/frontend-only.js';
    script.onload = function() {
        checkAuthStatus();
        initializeEventListeners();
        loadDashboardData();
    };
    document.head.appendChild(script);
});

// Check authentication status
function checkAuthStatus() {
    currentUser = window.frontendAPI.getCurrentUser();
    
    if (currentUser) {
        updateNavigation();
        return true;
    }
    return false;
}

// Update navigation based on auth status
function updateNavigation() {
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const userDropdown = document.getElementById('userDropdown');
    const userName = document.getElementById('userName');
    
    if (currentUser) {
        if (loginLink) loginLink.style.display = 'none';
        if (registerLink) registerLink.style.display = 'none';
        if (userDropdown) {
            userDropdown.style.display = 'block';
            if (userName) userName.textContent = currentUser.first_name;
        }
    } else {
        if (loginLink) loginLink.style.display = 'block';
        if (registerLink) registerLink.style.display = 'block';
        if (userDropdown) userDropdown.style.display = 'none';
    }
}

// Initialize event listeners
function initializeEventListeners() {
    // Form submissions
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const profileForm = document.getElementById('profileForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }
    
    if (profileForm) {
        profileForm.addEventListener('submit', handleProfileUpdate);
    }
    
    // Assessment navigation
    const nextQuestionBtn = document.getElementById('nextQuestion');
    const prevQuestionBtn = document.getElementById('prevQuestion');
    const submitAssessmentBtn = document.getElementById('submitAssessment');
    
    if (nextQuestionBtn) {
        nextQuestionBtn.addEventListener('click', nextQuestion);
    }
    
    if (prevQuestionBtn) {
        prevQuestionBtn.addEventListener('click', previousQuestion);
    }
    
    if (submitAssessmentBtn) {
        submitAssessmentBtn.addEventListener('click', submitAssessment);
    }
}

// Handle login
async function handleLogin(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const loginData = {
        username: formData.get('username'),
        password: formData.get('password')
    };
    
    try {
        const response = window.frontendAPI.authenticateUser(loginData.username, loginData.password);
        
        if (response.success) {
            localStorage.setItem('authToken', response.token);
            localStorage.setItem('currentUser', JSON.stringify(response.user));
            currentUser = response.user;
            
            showAlert('Login successful! Redirecting...', 'success');
            
            setTimeout(() => {
                if (response.user.user_type === 'admin') {
                    window.location.href = 'admin/dashboard.html';
                } else if (response.user.user_type === 'counselor') {
                    window.location.href = 'counselor/dashboard.html';
                } else {
                    window.location.href = 'dashboard.html';
                }
            }, 1500);
        } else {
            showAlert(response.message || 'Login failed', 'error');
        }
    } catch (error) {
        showAlert('Login error. Please try again.', 'error');
    }
}

// Handle registration
async function handleRegister(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const registerData = {
        username: formData.get('username'),
        email: formData.get('email'),
        password: formData.get('password'),
        first_name: formData.get('first_name'),
        last_name: formData.get('last_name'),
        user_type: formData.get('user_type') || 'student'
    };
    
    // Validate passwords match
    if (registerData.password !== formData.get('confirm_password')) {
        showAlert('Passwords do not match', 'error');
        return;
    }
    
    try {
        const response = window.frontendAPI.registerUser(registerData);
        
        if (response.success) {
            localStorage.setItem('authToken', response.token);
            localStorage.setItem('currentUser', JSON.stringify(response.user));
            currentUser = response.user;
            
            showAlert('Registration successful! Please login.', 'success');
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1500);
        } else {
            showAlert(response.message || 'Registration failed', 'error');
        }
    } catch (error) {
        showAlert('Registration error. Please try again.', 'error');
    }
}

// Handle profile update
async function handleProfileUpdate(e) {
    e.preventDefault();
    
    if (!currentUser) {
        showAlert('Please login first', 'error');
        return;
    }
    
    const formData = new FormData(e.target);
    const profileData = {
        date_of_birth: formData.get('date_of_birth'),
        gender: formData.get('gender'),
        phone: formData.get('phone'),
        address: formData.get('address'),
        education_level: formData.get('education_level'),
        current_education: formData.get('current_education'),
        interests: formData.get('interests'),
        career_goals: formData.get('career_goals')
    };
    
    try {
        const response = window.frontendAPI.updateUserProfile(profileData);
        
        if (response.success) {
            showAlert('Profile updated successfully!', 'success');
            loadProfileData();
        } else {
            showAlert(response.message || 'Profile update failed', 'error');
        }
    } catch (error) {
        showAlert('Profile update error. Please try again.', 'error');
    }
}

// Load dashboard data
async function loadDashboardData() {
    if (!currentUser || !window.location.pathname.includes('dashboard')) {
        return;
    }
    
    try {
        const response = window.frontendAPI.getDashboardData();
        
        if (response.success) {
            renderDashboardCharts(response.data);
            renderRecentAssessments(response.data.recent_assessments);
            renderCareerRecommendations(response.data.recommendations);
        }
    } catch (error) {
        console.error('Failed to load dashboard data:', error);
    }
}

// Load assessment questions
async function loadAssessmentQuestions(type) {
    try {
        const response = window.frontendAPI.getAssessmentQuestions(type);
        
        if (response.success) {
            assessmentSession = {
                type: type,
                questions: response.questions,
                currentQuestion: 0,
                answers: {}
            };
            
            renderCurrentQuestion();
            updateAssessmentProgress();
        } else {
            showAlert('Failed to load assessment questions', 'error');
        }
    } catch (error) {
        showAlert('Failed to load assessment questions', 'error');
    }
}

// Render current assessment question
function renderCurrentQuestion() {
    if (!assessmentSession || !assessmentSession.questions) return;
    
    const question = assessmentSession.questions[assessmentSession.currentQuestion];
    const questionContainer = document.getElementById('questionContainer');
    
    if (!questionContainer) return;
    
    let html = `
        <div class="question-card fade-in">
            <h4>Question ${assessmentSession.currentQuestion + 1} of ${assessmentSession.questions.length}</h4>
            <p class="lead">${question.question_text}</p>
            <div class="answers-container">
    `;
    
    if (question.question_type === 'multiple_choice') {
        const options = question.options;
        options.forEach((option, index) => {
            html += `
                <div class="answer-option" onclick="selectAnswer(${index})">
                    <input type="radio" name="answer" value="${index}" id="option${index}">
                    <label for="option${index}" class="ms-2">${option}</label>
                </div>
            `;
        });
    } else if (question.question_type === 'likert_scale') {
        const options = question.options;
        options.forEach((option, index) => {
            html += `
                <div class="answer-option" onclick="selectAnswer(${index})">
                    <input type="radio" name="answer" value="${index}" id="option${index}">
                    <label for="option${index}" class="ms-2">${option}</label>
                </div>
            `;
        });
    }
    
    html += `
            </div>
        </div>
    `;
    
    questionContainer.innerHTML = html;
    
    // Update navigation buttons
    const prevBtn = document.getElementById('prevQuestion');
    const nextBtn = document.getElementById('nextQuestion');
    const submitBtn = document.getElementById('submitAssessment');
    
    if (prevBtn) {
        prevBtn.style.display = assessmentSession.currentQuestion > 0 ? 'block' : 'none';
    }
    
    if (nextBtn) {
        nextBtn.style.display = assessmentSession.currentQuestion < assessmentSession.questions.length - 1 ? 'block' : 'none';
    }
    
    if (submitBtn) {
        submitBtn.style.display = assessmentSession.currentQuestion === assessmentSession.questions.length - 1 ? 'block' : 'none';
    }
    
    // Restore previous answer if exists
    const previousAnswer = assessmentSession.answers[assessmentSession.currentQuestion];
    if (previousAnswer !== undefined) {
        selectAnswer(previousAnswer);
    }
}

// Select answer
function selectAnswer(index) {
    const answerOptions = document.querySelectorAll('.answer-option');
    answerOptions.forEach((option, i) => {
        option.classList.remove('selected');
        const radio = option.querySelector('input[type="radio"]');
        if (radio) radio.checked = false;
    });
    
    answerOptions[index].classList.add('selected');
    const radio = answerOptions[index].querySelector('input[type="radio"]');
    if (radio) radio.checked = true;
    
    assessmentSession.answers[assessmentSession.currentQuestion] = index;
}

// Navigate to next question
function nextQuestion() {
    if (assessmentSession.currentQuestion < assessmentSession.questions.length - 1) {
        assessmentSession.currentQuestion++;
        renderCurrentQuestion();
        updateAssessmentProgress();
    }
}

// Navigate to previous question
function previousQuestion() {
    if (assessmentSession.currentQuestion > 0) {
        assessmentSession.currentQuestion--;
        renderCurrentQuestion();
        updateAssessmentProgress();
    }
}

// Update assessment progress
function updateAssessmentProgress() {
    const progressBar = document.getElementById('assessmentProgress');
    const progressText = document.getElementById('progressText');
    
    if (progressBar && assessmentSession) {
        const progress = ((assessmentSession.currentQuestion + 1) / assessmentSession.questions.length) * 100;
        progressBar.style.width = progress + '%';
        progressBar.setAttribute('aria-valuenow', progress);
        
        if (progressText) {
            progressText.textContent = `${Math.round(progress)}% Complete`;
        }
    }
}

// Submit assessment
async function submitAssessment() {
    if (!assessmentSession) return;
    
    // Check if all questions are answered
    const totalQuestions = assessmentSession.questions.length;
    const answeredQuestions = Object.keys(assessmentSession.answers).length;
    
    if (answeredQuestions < totalQuestions) {
        showAlert('Please answer all questions before submitting', 'error');
        return;
    }
    
    try {
        const response = window.frontendAPI.submitAssessment(assessmentSession.type, assessmentSession.answers);
        
        if (response.success) {
            showAlert('Assessment submitted successfully!', 'success');
            
            setTimeout(() => {
                window.location.href = `results.html?type=${assessmentSession.type}&id=${response.result_id}`;
            }, 1500);
        } else {
            showAlert(response.message || 'Failed to submit assessment', 'error');
        }
    } catch (error) {
        showAlert('Failed to submit assessment', 'error');
    }
}

// Load profile data
async function loadProfileData() {
    if (!currentUser) return;
    
    try {
        const response = window.frontendAPI.getUserProfile();
        
        if (response.success) {
            const profile = response.profile;
            
            // Fill form fields
            const form = document.getElementById('profileForm');
            if (form) {
                Object.keys(profile).forEach(key => {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) {
                        field.value = profile[key] || '';
                    }
                });
            }
        }
    } catch (error) {
        console.error('Failed to load profile data:', error);
    }
}

// Render recent assessments
function renderRecentAssessments(assessments) {
    const container = document.getElementById('recentAssessments');
    if (!container) return;
    
    let html = '';
    assessments.forEach(assessment => {
        html += `
            <div class="card mb-2">
                <div class="card-body">
                    <h6 class="card-title">${assessment.type === 'personality' ? 'Personality' : 'Aptitude'} Assessment</h6>
                    <p class="card-text">
                        <small class="text-muted">Completed on ${new Date(assessment.date).toLocaleDateString()}</small>
                    </p>
                    <a href="results.html?type=${assessment.type}&id=${assessment.id}" class="btn btn-sm btn-primary">View Results</a>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html || '<p>No assessments completed yet.</p>';
}

// Render career recommendations
function renderCareerRecommendations(recommendations) {
    const container = document.getElementById('careerRecommendations');
    if (!container) return;
    
    let html = '';
    recommendations.forEach(rec => {
        const matchClass = rec.match_score >= 80 ? 'match-high' : rec.match_score >= 60 ? 'match-medium' : 'match-low';
        
        html += `
            <div class="career-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5>${rec.career_title}</h5>
                        <p>${rec.description}</p>
                        <div class="mb-2">
                            <strong>Required Skills:</strong> ${rec.required_skills.join(', ')}
                        </div>
                        <div class="mb-2">
                            <strong>Education:</strong> ${rec.education_requirements}
                        </div>
                        <div class="mb-2">
                            <strong>Salary Range:</strong> ${rec.salary_range}
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="match-score ${matchClass}">${rec.match_score}% Match</span>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary" onclick="viewCareerDetails(${rec.career_id})">View Details</button>
                    <button class="btn btn-sm btn-outline-secondary" onclick="saveCareer(${rec.career_id})">Save</button>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html || '<p>No career recommendations available yet. Complete assessments to get recommendations.</p>';
}

// Render dashboard charts
function renderDashboardCharts(data) {
    // Personality traits chart
    const personalityCtx = document.getElementById('personalityChart');
    if (personalityCtx && data.personality_traits) {
        new Chart(personalityCtx, {
            type: 'radar',
            data: {
                labels: Object.keys(data.personality_traits),
                datasets: [{
                    label: 'Your Personality Traits',
                    data: Object.values(data.personality_traits),
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(0, 123, 255, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    }
    
    // Aptitude scores chart
    const aptitudeCtx = document.getElementById('aptitudeChart');
    if (aptitudeCtx && data.aptitude_scores) {
        new Chart(aptitudeCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(data.aptitude_scores),
                datasets: [{
                    label: 'Aptitude Scores',
                    data: Object.values(data.aptitude_scores),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    }
}

// Show alert message
function showAlert(message, type = 'info') {
    const alertContainer = document.getElementById('alertContainer');
    if (!alertContainer) return;
    
    const alertClass = type === 'success' ? 'alert-success-custom' : 
                      type === 'error' ? 'alert-error-custom' : 'alert-info-custom';
    
    const alertHtml = `
        <div class="alert-custom ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    alertContainer.innerHTML = alertHtml;
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
}

// Logout function
function logout() {
    window.frontendAPI.logout();
    currentUser = null;
    
    showAlert('Logged out successfully', 'success');
    
    setTimeout(() => {
        window.location.href = 'index.html';
    }, 1000);
}

// View career details
function viewCareerDetails(careerId) {
    // For now, just show a simple alert
    const careers = window.frontendAPI.getAllCareers().careers;
    const career = careers.find(c => c.career_id == careerId);
    if (career) {
        alert(`Career: ${career.career_title}\n\n${career.description}\n\nSalary: ${career.salary_range}\nEducation: ${career.education_requirements}`);
    }
}

// Save career for later
async function saveCareer(careerId) {
    if (!currentUser) {
        showAlert('Please login first', 'error');
        return;
    }
    
    try {
        const response = window.frontendAPI.saveCareer(careerId);
        
        if (response.success) {
            showAlert('Career saved for later!', 'success');
        } else {
            showAlert(response.message || 'Failed to save career', 'error');
        }
    } catch (error) {
        showAlert('Failed to save career', 'error');
    }
}

// Export functions for global use
window.checkAuthStatus = checkAuthStatus;
window.updateNavigation = updateNavigation;
window.handleLogin = handleLogin;
window.handleRegister = handleRegister;
window.handleProfileUpdate = handleProfileUpdate;
window.loadAssessmentQuestions = loadAssessmentQuestions;
window.selectAnswer = selectAnswer;
window.nextQuestion = nextQuestion;
window.previousQuestion = previousQuestion;
window.submitAssessment = submitAssessment;
window.logout = logout;
window.viewCareerDetails = viewCareerDetails;
window.saveCareer = saveCareer;
