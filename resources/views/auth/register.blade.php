@extends('layouts.site', ['title' => 'Register - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-user-plus me-2"></i>Create Account</h3>

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" required autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary-gradient" type="submit">Register</button>
                        <a class="btn btn-outline-secondary" href="{{ route('login') }}">Already registered? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
