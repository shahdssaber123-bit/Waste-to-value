<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCollectors = User::where('role', 'collector')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalCollectors', 'totalOrders', 'pendingOrders'));
    }

    // User management
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,collector,admin'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('admin.users')->with('success', 'User created.');
    }

    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:user,collector,admin'
        ]);

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'User updated.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }

    // Order management
    public function orders()
    {
        $orders = Order::with(['user', 'collector'])->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function assignCollector(Request $request, Order $order)
    {
        $request->validate([
            'collector_id' => 'required|exists:users,id,role,collector'
        ]);

        $order->update([
            'collector_id' => $request->collector_id,
            'status' => 'assigned' // or keep pending until collector starts
        ]);

        return redirect()->route('admin.orders')->with('success', 'Collector assigned.');
    }
}
