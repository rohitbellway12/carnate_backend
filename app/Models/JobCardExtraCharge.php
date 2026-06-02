<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardExtraCharge extends Model
{
    use HasFactory;

    protected $fillable =[
        'jobcard_id',
        'label',
        'charges',
        'charge_type',
        'mechanic_id',
        'amount',
        'gst_type',
        'gst',
        'outsource_price',
        'charge_type',
        'qty',
    ];

}
