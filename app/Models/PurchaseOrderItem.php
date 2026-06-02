<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'part_id',
        'part_name',
        'part_number',
        'brand',
        'category_id',
        'unit_id',
        'rack_no',
        'qty',
        'unit_price',
        'total',
        'hsn_code',
        'gst_percent',
        'discount',
        'discount_type',
        'selling_price',
        'taxable_amount',
        'cgst',
        'sgst',
        'cgst_percent',
        'sgst_percent',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function part()
{
    return $this->belongsTo(SparePart::class, 'part_id');
}

} 


// manish12-07-2025