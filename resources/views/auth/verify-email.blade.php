@extends('layouts.site', ['title' => 'Verify Email - Career Guidance Portal'])

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="auth-form">
                <h3><i class="fas fa-envelope-open-text me-2"></i>Verify Your Email</h3>
                <p class="text-muted small">
                    Thanks for signing up. Please verify your email address by clicking the link we emailed to you.
                    If you didn’t receive the email, you can request another.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">A new verification link has been sent to your email address.</div>
                @endif

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="btn btn-primary-gradient w-100" type="submit">Resend Verification Email</button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary w-100" type="submit">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
