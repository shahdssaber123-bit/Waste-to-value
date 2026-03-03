@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-transparent border-0 pt-4 text-center">
                <h3 class="fw-bold"><i class="bi bi-plus-circle-fill me-2" style="color: #667eea;"></i>New Waste Collection Request</h3>
                <p class="text-muted">Fill in the details below</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('user.orders.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="location" class="form-label"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>Location</label>
                        <input type="text" class="form-control form-control-lg @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required placeholder="Enter full address">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"><i class="bi bi-pencil-square me-1"></i>Description</label>
                        <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" id="description" name="description" rows="3" required placeholder="Describe the waste type, quantity, etc.">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="scheduled_date" class="form-label"><i class="bi bi-calendar-event me-1"></i>Scheduled Date (optional)</label>
                        <input type="date" class="form-control form-control-lg" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date') }}">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check2-circle me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
