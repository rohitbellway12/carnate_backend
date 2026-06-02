<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'partname',
        'part_no',
        'company_name',
        'category',
        'quantity',
        'unit_id',
        'rack_no',
        'total_payable',
        'purchase_order_id',
        'tax_percentage',
    ];



public function purchaseOrderItems()
{
    return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'purchase_order_id');
}

  public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

}
