<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    public function dashboard()
    {
        $assignedOrders = Order::where('collector_id', Auth::id())
            ->whereIn('status', ['assigned', 'in_progress'])
            ->count();

        $completedToday = Order::where('collector_id', Auth::id())
            ->where('status', 'completed')
            ->whereDate('updated_at', today())
            ->count();

        return view('collector.dashboard', compact('assignedOrders', 'completedToday'));
    }

    public function orders()
    {
        $orders = Order::where('collector_id', Auth::id())
            ->with('user')
            ->paginate(10);

        return view('collector.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Ensure this order is assigned to this collector
        if ($order->collector_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:in_progress,completed'
        ]);

        // Status flow: pending/assigned → in_progress → completed
        $allowed = ['pending', 'assigned'];

        if ($request->status === 'in_progress' && !in_array($order->status, $allowed)) {
            return back()->withErrors(['status' => 'Cannot move to in_progress from current status.']);
        }

        if ($request->status === 'completed' && $order->status !== 'in_progress') {
            return back()->withErrors(['status' => 'Order must be in progress before completing.']);
        }

        $order->update(['status' => $request->status]);

        return redirect()->route('collector.orders')->with('success', 'Order status updated.');
    }
}
