<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'collector_id', 'location', 'description',
        'scheduled_date', 'status'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
