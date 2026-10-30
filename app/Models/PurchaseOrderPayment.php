<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderPayment extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_payments';

    protected $fillable = [
        'purchase_order_id',
        'amount',
        'payment_type',
        'transaction_number',
        'payment_date',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }
}

