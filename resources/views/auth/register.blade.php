@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-transparent border-0 text-center pt-4">
                <h3 class="fw-bold"><i class="bi bi-person-plus-fill me-2" style="color: #667eea;"></i>Create Account</h3>
                <p class="text-muted">Join Smart Waste Management</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="bi bi-person me-1"></i>Full Name</label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="bi bi-envelope me-1"></i>Email Address</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill me-1"></i>Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="form-label"><i class="bi bi-briefcase me-1"></i>Register as</label>
                        <select class="form-select form-select-lg" id="role" name="role">
                            <option value="user" selected>User</option>
                            <option value="collector">Collector</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Register
                    </button>
                </form>
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-4">
                <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
