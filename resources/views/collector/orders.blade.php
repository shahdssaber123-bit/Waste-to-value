@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-truck me-2"></i>My Assigned Orders</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>User</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><span class="badge bg-secondary">#{{ $order->id }}</span></td>
                        <td><i class="bi bi-person-circle me-1"></i>{{ $order->user->name }}</td>
                        <td><i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $order->location }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'in_progress' => 'primary',
                                    'completed' => 'success',
                                    'assigned' => 'info'
                                ];
                                $color = $statusColors[$order->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                        </td>
                        <td>
                            @if(in_array($order->status, ['assigned', 'in_progress']))
                                <form action="{{ route('collector.orders.update', $order) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" style="width: auto;">
                                        <option value="" selected disabled>Change status</option>
                                        @if($order->status == 'assigned')
                                            <option value="in_progress">Start (In Progress)</option>
                                        @elseif($order->status == 'in_progress')
                                            <option value="completed">Complete</option>
                                        @endif
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-arrow-repeat"></i> Update
                                    </button>
                                </form>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Completed</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
