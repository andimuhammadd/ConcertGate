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
}
