@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-house-heart-fill me-2" style="color: #667eea;"></i>User Dashboard</h1>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-5">
                <i class="bi bi-plus-circle-fill display-1" style="color: #667eea;"></i>
                <h5 class="card-title mt-4">Create New Order</h5>
                <p class="card-text text-muted">Request waste collection from your location.</p>
                <a href="{{ route('user.orders.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-lg me-2"></i>Create Order
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-5">
                <i class="bi bi-list-check display-1" style="color: #38ef7d;"></i>
                <h5 class="card-title mt-4">My Orders</h5>
                <p class="card-text text-muted">Track status and history of your requests.</p>
                <a href="{{ route('user.orders') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-eye me-2"></i>View Orders
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
