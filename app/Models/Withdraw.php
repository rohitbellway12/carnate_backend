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
    ];
     
    public function SparePartVendor()
    {
        return $this->belongsTo(SparePartVendor::class, 'user_id');
    }
}
