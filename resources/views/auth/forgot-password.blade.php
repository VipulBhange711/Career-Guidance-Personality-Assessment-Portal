@extends('layouts.site', ['title' => 'Forgot Password - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-unlock-alt me-2"></i>Forgot Password</h3>
                <p class="text-muted small">
                    Enter your email address to receive a password reset link.
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary-gradient" type="submit">Email Password Reset Link</button>
                        <a class="btn btn-outline-secondary" href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
