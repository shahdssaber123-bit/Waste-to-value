@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-transparent border-0 text-center pt-4">
                <h3 class="fw-bold"><i class="bi bi-box-arrow-in-right me-2" style="color: #667eea;"></i>Welcome Back</h3>
                <p class="text-muted">Login to your account</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="bi bi-envelope me-1"></i>Email Address</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="bi bi-lock me-1"></i>Password</label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-4">
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
