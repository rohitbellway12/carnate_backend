<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'total',
        'order_id',
        'type'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
