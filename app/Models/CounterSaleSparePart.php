<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterSaleSparePart extends Model
{
    use HasFactory;
    protected $table = "counter_sale_spare_parts";

    protected $fillable = [
        'countersale_id', 
        'stock_label_id', 
        'stock_label_name',
        'quantity', 
        'price', 
        'total_amount', 
        'discount', 
        'final_amount', 
        'discount_type', 
        'product_id', 
        
    ]; 
}
