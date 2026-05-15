@extends('layouts.site', ['title' => 'Reset Password - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-key me-2"></i>Reset Password</h3>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary-gradient" type="submit">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
