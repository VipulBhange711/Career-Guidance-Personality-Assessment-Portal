// Frontend-only Career Guidance Portal - No PHP Backend

// Mock Data
const mockData = {
    users: [
        {
            user_id: 1,
            username: 'student',
            email: 'student@careerportal.com',
            password: 'Password@123', // In real app, this would be hashed
            first_name: 'John',
            last_name: 'Student',
            user_type: 'student',
            created_at: new Date().toISOString(),
            is_active: true
        },
        {
            user_id: 2,
            username: 'counselor',
            email: 'counselor@careerportal.com',
            password: 'Password@123',
            first_name: 'Sarah',
            last_name: 'Counselor',
            user_type: 'counselor',
            created_at: new Date().toISOString(),
            is_active: true
        },
        {
            user_id: 3,
            username: 'admin',
            email: 'admin@careerportal.com',
            password: 'password',
            first_name: 'System',
            last_name: 'Administrator',
            user_type: 'admin',
            created_at: new Date().toISOString(),
            is_active: true
        }
    ],
    
    profiles: [
        {
            user_id: 1,
            date_of_birth: '2000-01-15',
            gender: 'male',
            phone: '+1234567890',
            address: '123 Student Street, City',
            education_level: 'undergraduate',
            current_education: 'Computer Science',
            interests: 'Programming, Technology, Gaming',
            career_goals: 'Become a Software Developer'
        },
        {
            user_id: 2,
            date_of_birth: '1985-05-20',
            gender: 'female',
            phone: '+1234567891',
            address: '456 Counselor Avenue, City',
            education_level: 'graduate',
            current_education: 'Psychology',
            interests: 'Career Counseling, Student Development',
            career_goals: 'Help students achieve their career goals'
        }
    ],
    
    personalityQuestions: [
        {
            question_id: 1,
            question_text: 'I prefer to work alone rather than in a team',
            question_type: 'likert_scale',
            category: 'Social',
            options: ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']
        },
        {
            question_id: 2,
            question_text: 'I enjoy solving complex problems',
            question_type: 'likert_scale',
            category: 'Analytical',
            options: ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']
        },
        {
            question_id: 3,
            question_text: 'I prefer structured and organized work environments',
            question_type: 'likert_scale',
            category: 'Organizational',
            options: ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']
        },
        {
            question_id: 4,
            question_text: 'I am comfortable taking risks',
            question_type: 'likert_scale',
            category: 'Risk_Taking',
            options: ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']
        },
        {
            question_id: 5,
            question_text: 'I enjoy creative and artistic activities',
            question_type: 'likert_scale',
            category: 'Creative',
            options: ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree']
        }
        // Add more questions as needed
    ],
    
    aptitudeQuestions: [
        {
            question_id: 1,
            question_text: 'What is the next number in the sequence: 2, 4, 8, 16, ?',
            question_type: 'multiple_choice',
            category: 'Logical',
            options: ['20', '24', '32', '28'],
            correct_answer: '2',
            difficulty_level: 'easy'
        },
        {
            question_id: 2,
            question_text: 'If a shirt costs $20 and is discounted by 25%, what is the final price?',
            question_type: 'multiple_choice',
            category: 'Numerical',
            options: ['$15', '$18', '$12', '$25'],
            correct_answer: '0',
            difficulty_level: 'easy'
        },
        {
            question_id: 3,
            question_text: 'Which word does not belong: Apple, Banana, Carrot, Orange',
            question_type: 'multiple_choice',
            category: 'Verbal',
            options: ['Apple', 'Banana', 'Carrot', 'Orange'],
            correct_answer: '2',
            difficulty_level: 'easy'
        }
        // Add more questions as needed
    ],
    
    careers: [
        {
            career_id: 1,
            career_title: 'Software Developer',
            description: 'Design, develop, and test software applications and systems',
            required_skills: ['Programming', 'Problem-solving', 'Logic', 'Mathematics'],
            education_requirements: 'Bachelor\'s in Computer Science',
            salary_range: '$60,000 - $120,000',
            job_outlook: 'Excellent',
            work_environment: 'Office, Remote',
            personality_matches: ['Analytical', 'Logical'],
            aptitude_requirements: { numerical: 80, logical: 90 }
        },
        {
            career_id: 2,
            career_title: 'Teacher',
            description: 'Educate students and help them develop academic and social skills',
            required_skills: ['Communication', 'Patience', 'Subject knowledge', 'Leadership'],
            education_requirements: 'Bachelor\'s in Education',
            salary_range: '$40,000 - $70,000',
            job_outlook: 'Good',
            work_environment: 'School',
            personality_matches: ['Social', 'Organizational'],
            aptitude_requirements: { verbal: 85, logical: 70 }
        },
        {
            career_id: 3,
            career_title: 'Graphic Designer',
            description: 'Create visual concepts using computer software or by hand',
            required_skills: ['Creativity', 'Artistic skills', 'Communication', 'Software proficiency'],
            education_requirements: 'Bachelor\'s in Design',
            salary_range: '$45,000 - $85,000',
            job_outlook: 'Good',
            work_environment: 'Studio, Office',
            personality_matches: ['Creative', 'Social'],
            aptitude_requirements: { spatial: 90, verbal: 60 }
        }
        // Add more careers as needed
    ]
};

// Local Storage Functions
function saveToLocalStorage(key, data) {
    localStorage.setItem(key, JSON.stringify(data));
}

function getFromLocalStorage(key) {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
}

// Authentication Functions
function hashPassword(password) {
    // Simple hash for demo (in production, use proper hashing)
    return btoa(password);
}

function verifyPassword(password, hash) {
    return hashPassword(password) === hash;
}

function authenticateUser(username, password) {
    const user = mockData.users.find(u => u.username === username);
    if (user && verifyPassword(password, user.password)) {
        return {
            success: true,
            token: btoa(user.username + Date.now()), // Simple token
            user: {
                user_id: user.user_id,
                username: user.username,
                email: user.email,
                first_name: user.first_name,
                last_name: user.last_name,
                user_type: user.user_type
            }
        };
    }
    return { success: false, message: 'Invalid username or password' };
}

function registerUser(userData) {
    // Check if user already exists
    if (mockData.users.find(u => u.username === userData.username || u.email === userData.email)) {
        return { success: false, message: 'Username or email already exists' };
    }
    
    // Create new user
    const newUser = {
        user_id: mockData.users.length + 1,
        ...userData,
        password: hashPassword(userData.password),
        created_at: new Date().toISOString(),
        is_active: true
    };
    
    mockData.users.push(newUser);
    
    // Create empty profile
    mockData.profiles.push({
        user_id: newUser.user_id,
        date_of_birth: null,
        gender: null,
        phone: null,
        address: null,
        education_level: null,
        current_education: null,
        interests: null,
        career_goals: null
    });
    
    return {
        success: true,
        token: btoa(newUser.username + Date.now()),
        user: {
            user_id: newUser.user_id,
            username: newUser.username,
            email: newUser.email,
            first_name: newUser.first_name,
            last_name: newUser.last_name,
            user_type: newUser.user_type
        }
    };
}

// Assessment Functions
function getAssessmentQuestions(type) {
    if (type === 'personality') {
        return {
            success: true,
            questions: mockData.personalityQuestions,
            total_questions: mockData.personalityQuestions.length
        };
    } else if (type === 'aptitude') {
        return {
            success: true,
            questions: mockData.aptitudeQuestions,
            total_questions: mockData.aptitudeQuestions.length
        };
    }
    return { success: false, message: 'Invalid assessment type' };
}

function submitAssessment(type, answers) {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: false, message: 'User not authenticated' };
    }
    
    let result;
    if (type === 'personality') {
        // Calculate personality traits (simplified)
        const traits = {
            'Openness': Math.floor(Math.random() * 30) + 70,
            'Conscientiousness': Math.floor(Math.random() * 30) + 70,
            'Extraversion': Math.floor(Math.random() * 30) + 70,
            'Agreeableness': Math.floor(Math.random() * 30) + 70,
            'Neuroticism': Math.floor(Math.random() * 30) + 70
        };
        
        const personalityTypes = ['INFP', 'ISTJ', 'ENFP', 'ESFJ', 'ISFJ', 'INTP'];
        const personalityType = personalityTypes[Math.floor(Math.random() * personalityTypes.length)];
        
        result = {
            result_id: Date.now(),
            personality_type: personalityType,
            traits: traits,
            scores: traits,
            interpretation: `Your personality type is ${personalityType}. You show balanced traits across all dimensions.`
        };
        
        // Save to localStorage
        const personalityResults = getFromLocalStorage('personalityResults') || [];
        personalityResults.push({
            ...result,
            user_id: currentUser.user_id,
            assessment_date: new Date().toISOString()
        });
        saveToLocalStorage('personalityResults', personalityResults);
        
    } else if (type === 'aptitude') {
        // Calculate aptitude scores (simplified)
        const categoryScores = {
            'Logical': Math.floor(Math.random() * 30) + 70,
            'Numerical': Math.floor(Math.random() * 30) + 70,
            'Verbal': Math.floor(Math.random() * 30) + 70,
            'Spatial': Math.floor(Math.random() * 30) + 70
        };
        
        const totalScore = Math.floor(Object.values(categoryScores).reduce((a, b) => a + b, 0) / 4);
        
        result = {
            result_id: Date.now(),
            total_score: totalScore,
            category_scores: categoryScores,
            percentile_rank: Math.floor(Math.random() * 30) + 70,
            interpretation: `Your overall aptitude score is ${totalScore}%. You show strong abilities in several areas.`
        };
        
        // Save to localStorage
        const aptitudeResults = getFromLocalStorage('aptitudeResults') || [];
        aptitudeResults.push({
            ...result,
            user_id: currentUser.user_id,
            assessment_date: new Date().toISOString()
        });
        saveToLocalStorage('aptitudeResults', aptitudeResults);
    }
    
    return {
        success: true,
        result_id: result.result_id
    };
}

// Career Functions
function getAllCareers() {
    return {
        success: true,
        careers: mockData.careers
    };
}

function getCareerRecommendations() {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: true, careers: [] };
    }
    
    // Get user's assessment results
    const personalityResults = getFromLocalStorage('personalityResults') || [];
    const aptitudeResults = getFromLocalStorage('aptitudeResults') || [];
    
    // Calculate match scores (simplified)
    const recommendations = mockData.careers.map(career => {
        const matchScore = Math.floor(Math.random() * 40) + 60; // 60-100%
        return {
            ...career,
            match_score: matchScore
        };
    });
    
    // Sort by match score
    recommendations.sort((a, b) => b.match_score - a.match_score);
    
    return {
        success: true,
        careers: recommendations.slice(0, 10)
    };
}

function saveCareer(careerId) {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: false, message: 'User not authenticated' };
    }
    
    const savedCareers = getFromLocalStorage('savedCareers') || [];
    const career = mockData.careers.find(c => c.career_id == careerId);
    
    if (career && !savedCareers.find(c => c.career_id == careerId)) {
        savedCareers.push({
            ...career,
            user_id: currentUser.user_id,
            saved_date: new Date().toISOString()
        });
        saveToLocalStorage('savedCareers', savedCareers);
    }
    
    return { success: true, message: 'Career saved successfully' };
}

// Profile Functions
function getUserProfile() {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: false, message: 'User not authenticated' };
    }
    
    const profile = mockData.profiles.find(p => p.user_id === currentUser.user_id);
    return {
        success: true,
        user: currentUser,
        profile: profile || {}
    };
}

function updateUserProfile(profileData) {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: false, message: 'User not authenticated' };
    }
    
    const profileIndex = mockData.profiles.findIndex(p => p.user_id === currentUser.user_id);
    if (profileIndex >= 0) {
        mockData.profiles[profileIndex] = {
            ...mockData.profiles[profileIndex],
            ...profileData
        };
    } else {
        mockData.profiles.push({
            user_id: currentUser.user_id,
            ...profileData
        });
    }
    
    return { success: true, message: 'Profile updated successfully' };
}

// Dashboard Functions
function getDashboardData() {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        return { success: false, message: 'User not authenticated' };
    }
    
    const profile = mockData.profiles.find(p => p.user_id === currentUser.user_id);
    const personalityResults = getFromLocalStorage('personalityResults') || [];
    const aptitudeResults = getFromLocalStorage('aptitudeResults') || [];
    const savedCareers = getFromLocalStorage('savedCareers') || [];
    
    // Calculate stats
    const stats = {
        assessments_completed: personalityResults.length + aptitudeResults.length,
        saved_careers: savedCareers.length,
        recommendations: mockData.careers.length,
        days_active: Math.floor((Date.now() - new Date(currentUser.created_at)) / (1000 * 60 * 60 * 24))
    };
    
    // Get latest results
    const latestPersonality = personalityResults[personalityResults.length - 1];
    const latestAptitude = aptitudeResults[aptitudeResults.length - 1];
    
    return {
        success: true,
        user: currentUser,
        profile_completion: profile ? 75 : 0, // Simplified
        stats: stats,
        personality_traits: latestPersonality ? latestPersonality.traits : null,
        aptitude_scores: latestAptitude ? latestAptitude.category_scores : null,
        progress_timeline: [], // Simplified
        recommendations: getCareerRecommendations().careers.slice(0, 6),
        recent_assessments: [], // Simplified
        saved_careers: savedCareers.slice(0, 5)
    };
}

// Utility Functions
function getCurrentUser() {
    const token = localStorage.getItem('authToken');
    const user = localStorage.getItem('currentUser');
    return user ? JSON.parse(user) : null;
}

function logout() {
    localStorage.removeItem('authToken');
    localStorage.removeItem('currentUser');
    return true;
}

// Export functions for use in main.js
window.frontendAPI = {
    authenticateUser,
    registerUser,
    getAssessmentQuestions,
    submitAssessment,
    getAllCareers,
    getCareerRecommendations,
    saveCareer,
    getUserProfile,
    updateUserProfile,
    getDashboardData,
    getCurrentUser,
    logout
};
