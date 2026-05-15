@extends('layouts.site', ['title' => 'Profile - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                            <h4 id="profileName">{{ $user->name }}</h4>
                            <p class="text-muted" id="profileEmail">{{ $user->email }}</p>
                            <span class="badge bg-primary" id="profileType">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Quick Actions</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('assessment.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-clipboard-list me-2"></i>Take Assessment
                                </a>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-chart-line me-2"></i>View Dashboard
                                </a>
                                <a href="{{ route('careers.index') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-briefcase me-2"></i>Browse Careers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="profile-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Personal Information</h4>
                            <button class="btn btn-primary" type="button" id="toggleEditBtn">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </button>
                        </div>

                        <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" disabled required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" disabled required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" disabled required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $profile?->date_of_birth) }}" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" disabled>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $profile?->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $profile?->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $profile?->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $profile?->phone) }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" disabled>{{ old('address', $profile?->address) }}</textarea>
                            </div>

                            <hr>
                            <h4 class="mb-4">Education Information</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="education_level" class="form-label">Education Level</label>
                                    <select class="form-select" id="education_level" name="education_level" disabled>
                                        <option value="">Select Education Level</option>
                                        <option value="high_school" {{ old('education_level', $profile?->education_level) === 'high_school' ? 'selected' : '' }}>High School</option>
                                        <option value="undergraduate" {{ old('education_level', $profile?->education_level) === 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                        <option value="graduate" {{ old('education_level', $profile?->education_level) === 'graduate' ? 'selected' : '' }}>Graduate</option>
                                        <option value="postgraduate" {{ old('education_level', $profile?->education_level) === 'postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="current_education" class="form-label">Current Education/Field</label>
                                    <input type="text" class="form-control" id="current_education" name="current_education" value="{{ old('current_education', $profile?->current_education) }}" disabled>
                                </div>
                            </div>

                            <hr>
                            <h4 class="mb-4">Career Preferences</h4>

                            <div class="mb-3">
                                <label for="interests" class="form-label">Interests & Hobbies</label>
                                <textarea class="form-control" id="interests" name="interests" rows="3" disabled>{{ old('interests', $profile?->interests) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="career_goals" class="form-label">Career Goals</label>
                                <textarea class="form-control" id="career_goals" name="career_goals" rows="3" disabled>{{ old('career_goals', $profile?->career_goals) }}</textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary" id="cancelBtn" style="display: none;">Cancel</button>
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
                                <button class="btn btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </button>
                            </div>
                            <div class="col-md-6">
                                <h6>Delete Account</h6>
                                <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    <i class="fas fa-trash me-2"></i>Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="passwordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="password" required minlength="8">
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_new_password" name="password_confirmation" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="passwordForm">Change Password</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">This action is irreversible. Please confirm your password to delete your account.</p>
                    <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="delete_password" name="password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" form="deleteAccountForm">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const toggleBtn = document.getElementById('toggleEditBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const saveBtn = document.getElementById('saveBtn');
            const form = document.getElementById('profileForm');
            const fields = form.querySelectorAll('input, select, textarea');

            let editMode = false;
            function setEditMode(enabled) {
                editMode = enabled;
                fields.forEach(el => {
                    if (el.name === '_token' || el.name === '_method') return;
                    el.disabled = !enabled;
                });
                cancelBtn.style.display = enabled ? '' : 'none';
                saveBtn.style.display = enabled ? '' : 'none';
                toggleBtn.style.display = enabled ? 'none' : '';
            }

            toggleBtn.addEventListener('click', () => setEditMode(true));
            cancelBtn.addEventListener('click', () => window.location.reload());
        })();
    </script>
@endpush
