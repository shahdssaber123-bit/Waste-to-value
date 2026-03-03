@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-list-check me-2"></i>All Orders</h1>
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
                        <th>Collector</th>
                        <th>Actions</th>
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
                            @if($order->collector)
                                <span class="badge bg-info"><i class="bi bi-person-badge me-1"></i>{{ $order->collector->name }}</span>
                            @else
                                <span class="text-muted fst-italic">Unassigned</span>
                            @endif
                        </td>
                        <td>
                            @if(!$order->collector_id)
                                <form action="{{ route('admin.orders.assign', $order) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <select name="collector_id" class="form-select form-select-sm" style="width: auto;" required>
                                        <option value="" selected disabled>Select collector</option>
                                        @foreach(\App\Models\User::where('role','collector')->get() as $collector)
                                            <option value="{{ $collector->id }}">{{ $collector->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-check-lg"></i> Assign
                                    </button>
                                </form>
                            @else
                                <span class="text-muted"><i class="bi bi-check-circle-fill text-success"></i> Assigned</span>
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
