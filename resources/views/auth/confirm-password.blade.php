@extends('layouts.site', ['title' => 'Confirm Password - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-shield-alt me-2"></i>Confirm Password</h3>
                <p class="text-muted small">This is a secure area. Please confirm your password to continue.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary-gradient" type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
