<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'withdraw_date',
        'transaction_id',
    ];
     
    public function SparePartVendor()
    {
        return $this->belongsTo(SparePartVendor::class, 'user_id');
    }
}
