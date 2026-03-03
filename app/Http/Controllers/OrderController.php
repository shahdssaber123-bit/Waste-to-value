<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        return view('user.create-order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_date' => 'nullable|date|after:today'
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'location' => $request->location,
            'description' => $request->description,
            'scheduled_date' => $request->scheduled_date,
            'status' => 'pending'
        ]);

        return redirect()->route('user.orders')->with('success', 'Order created.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('rating')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.my-orders', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.order-detail', compact('order'));
    }
}
