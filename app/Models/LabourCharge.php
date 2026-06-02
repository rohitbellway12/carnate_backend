<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourCharge extends Model
{
    use HasFactory;
    
        protected $fillable = [
        'price',
        'title',
        'gst',
        'gst_type',
        'total',
        'user_id',
        'status',
        'type',
        'profit',
        'outsource_price',
        'labour_type',
        'puchase_price'
    ];
}
