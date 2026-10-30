<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'po_no',
        'po_date',
        'bill_no',
        'bill_date',
        'po_status',
        'supplier_id',
        'note',
        'subtotal',
        'taxable_subtotal',
        'gst',
        'total_payable',
        'po_payment',
        'balance',
        'paid',
        'transaction_type',
        'transaction_date',
        'transaction_no',
        'transporter_name',
        'received_date',
        'vehicle_number',
        'delivery_person',
        'lt_number',
        'return_amount',
        'previous_balance',
        'total_balance',
    ];

    public function supplier()
    {
        return $this->belongsTo(SparePartSupplier::class, 'supplier_id');
    }
// manish12-07-2025
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
    public function payments()
    {
        return $this->hasMany(PurchaseOrderPayment::class, 'purchase_order_id');
    }
}