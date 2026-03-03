<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;

// Public routes
Route::get('/', function () {
    return view('user.welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated routes with role-based redirection
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'collector') return redirect()->route('collector.dashboard');
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::post('/orders/{order}/assign', [AdminController::class, 'assignCollector'])->name('orders.assign');
    });

    // Collector routes
    Route::middleware('role:collector')->prefix('collector')->name('collector.')->group(function () {
        Route::get('/dashboard', [CollectorController::class, 'dashboard'])->name('dashboard');
        Route::get('/orders', [CollectorController::class, 'orders'])->name('orders');
        Route::post('/orders/{order}/update', [CollectorController::class, 'updateStatus'])->name('orders.update');
    });

    // User routes
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    });

    // Rating (accessible only by user who owns the order)
    Route::post('/ratings/{order}', [RatingController::class, 'store'])->name('ratings.store')->middleware('role:user');
});
