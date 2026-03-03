@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-person-workspace me-2"></i>Collector Dashboard</h1>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Assigned Orders</h6>
                    <p class="display-6 mb-0">{{ $assignedOrders }}</p>
                </div>
                <i class="bi bi-truck fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Completed Today</h6>
                    <p class="display-6 mb-0">{{ $completedToday }}</p>
                </div>
                <i class="bi bi-check2-circle fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <a href="{{ route('collector.orders') }}" class="btn btn-primary btn-lg">
        <i class="bi bi-list-task me-2"></i>View My Orders
    </a>
</div>
@endsection
