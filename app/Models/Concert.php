<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'venue',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getQty()
    {
        return $this->tickets()->sum('quantity');
    }

    public function getTotalSoldAttribute()
    {
        return $this->tickets->sum(function ($ticket) {
            return $ticket->orderItems->sum('quantity');
        });
    }

    public function getTotalRevenueAttribute()
    {
        return $this->tickets->sum(function ($ticket) {
            return $ticket->orderItems->sum(function ($orderItem) {
                return $orderItem->price * $orderItem->quantity;
            });
        });
    }
}
