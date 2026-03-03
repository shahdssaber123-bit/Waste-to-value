@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-bag-check me-2"></i>My Orders</h1>
    <a href="{{ route('user.orders.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>New Order
    </a>
</div>

@forelse($orders as $order)
<div class="card mb-3 shadow-sm border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="card-title">
                    <span class="badge bg-secondary me-2">#{{ $order->id }}</span>
                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'in_progress' ? 'primary' : 'success') }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </h5>
                <p class="mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i><strong>Location:</strong> {{ $order->location }}</p>
                <p class="mb-1"><i class="bi bi-calendar me-1"></i><strong>Scheduled:</strong> {{ $order->scheduled_date ?? 'Not set' }}</p>
                <p class="mb-0"><i class="bi bi-chat-left-text me-1"></i><strong>Description:</strong> {{ $order->description }}</p>
            </div>
            <div>
                @if($order->collector)
                    <span class="badge bg-info"><i class="bi bi-person-badge me-1"></i>Collector: {{ $order->collector->name }}</span>
                @endif
            </div>
        </div>

        @if($order->status == 'completed' && !$order->rating)
            <hr>
            <form action="{{ route('ratings.store', $order) }}" method="POST" class="mt-3">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-star-fill text-warning"></i> Rate (1-5)</label>
                        <select name="value" class="form-select" required>
                            <option value="" selected disabled>Select</option>
                            @for($i=1;$i<=5;$i++)
                                <option value="{{ $i }}">{{ $i }} star{{ $i>1?'s':'' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-chat"></i> Comment (optional)</label>
                        <input type="text" name="comment" class="form-control" placeholder="Leave a comment">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-send me-1"></i>Submit Rating
                        </button>
                    </div>
                </div>
            </form>
        @elseif($order->rating)
            <div class="mt-3 p-3 bg-light rounded">
                <p class="mb-0"><strong>Your rating:</strong>
                    @for($i=1;$i<=5;$i++)
                        <i class="bi bi-star{{ $i <= $order->rating->value ? '-fill text-warning' : '' }}"></i>
                    @endfor
                    ({{ $order->rating->value }}/5)
                </p>
                @if($order->rating->comment)
                    <p class="mb-0 mt-2"><i class="bi bi-chat-quote"></i> "{{ $order->rating->comment }}"</p>
                @endif
            </div>
        @endif
    </div>
</div>
@empty
<div class="card shadow-sm border-0">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox-fill display-1 text-muted"></i>
        <h4 class="mt-3">No orders yet</h4>
        <p class="text-muted">Create your first waste collection request now!</p>
        <a href="{{ route('user.orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Create Order
        </a>
    </div>
</div>
@endforelse

<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
@endsection
