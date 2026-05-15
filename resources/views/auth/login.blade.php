@extends('layouts.site', ['title' => 'Login - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-sign-in-alt me-2"></i>Login</h3>

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                    </div>

                    <div class="mb-3 form-check">
                        <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary-gradient" type="submit">Log in</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">Forgot your password?</a>
                        @endif
                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
