<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Ensure order belongs to user and is completed
        if ($order->user_id !== Auth::id() || $order->status !== 'completed') {
            abort(403);
        }

        // Check if already rated
        if ($order->rating) {
            return back()->withErrors(['error' => 'Order already rated.']);
        }

        $request->validate([
            'value' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        Rating::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'value' => $request->value,
            'comment' => $request->comment
        ]);

        return redirect()->route('user.orders')->with('success', 'Thank you for your rating!');
    }
}