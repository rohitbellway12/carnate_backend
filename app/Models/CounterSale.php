<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterSale extends Model
{
    use HasFactory;
    protected $table = "countersales";

    protected $fillable = [
        'countersale_number', 
        'date', 
        'customer_id',
        'subtotal', 
        'total', 
        'final_amount', 
        'payment_type', 
        'balance', 
        'note',  
        'partial_amount',  
        'status',  
        'type',  
        'workshop_id',  
        'sparepart_id',
        'staff_id',
        'is_gst',
    ]; 
    
     static $status = [
        0 => '<span class="badge bg-danger">Un-paid</span>',
        1 => '<span class="badge bg-primary">Partial Payment</span>',
        2 => '<span class="badge bg-success">full Paid</span>',
    ];

    public function Customer()
    {
        return $this->belongsTo(CounterCustomers::class, 'customer_id');
    }
    
     public function counterSalesSpareParts(){
        return $this->hasMany(CounterSaleSparePart::class,'countersale_id','id');
    }
}
