<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Orders created by this user (as a regular user)
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // Orders assigned to this user (as a collector)
    public function assignedOrders()
    {
        return $this->hasMany(Order::class, 'collector_id');
    }

    // Ratings given by this user
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
