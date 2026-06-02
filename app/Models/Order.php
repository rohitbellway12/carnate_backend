<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
     protected $fillable = ['is_confim', 'jobcard_id'];

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }
    
    public function jobCard()
    {
        return $this->belongsTo(WorkshopJobCard::class, 'jobcard_id');
    }
    
    public function workShopVendor(){
       return $this->belongsTo(WorkShopVendor::class,'workshop_id');
    }
    
     public function sparePartVendor(){
       return $this->belongsTo(SparePartVendor::class,'sparepart_id');
    }
}
