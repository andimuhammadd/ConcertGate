<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'concert_id',
        'type',
        'price',
        'quantity',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
