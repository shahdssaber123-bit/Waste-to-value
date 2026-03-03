@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-shield-lock-fill me-2"></i>Admin Dashboard</h1>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Users</h6>
                    <p class="display-6 mb-0">{{ $totalUsers }}</p>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Collectors</h6>
                    <p class="display-6 mb-0">{{ $totalCollectors }}</p>
                </div>
                <i class="bi bi-person-badge-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Orders</h6>
                    <p class="display-6 mb-0">{{ $totalOrders }}</p>
                </div>
                <i class="bi bi-clipboard-data-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Pending Orders</h6>
                    <p class="display-6 mb-0">{{ $pendingOrders }}</p>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="mt-5 d-flex gap-3">
    <a href="{{ route('admin.users') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-people me-2"></i>Manage Users
    </a>
    <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-lg">
        <i class="bi bi-list-check me-2"></i>Manage Orders
    </a>
</div>
@endsection
