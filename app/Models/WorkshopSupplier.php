<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopSupplier extends Model
{
    protected $fillable = [
        'mobile_no',
        'business_first_name',
        'business_address',
        'gstin',
        'owner_first_name',
        'contact_1',
        'contact_2',
        'email',
        'user_id',
    ];
    
}
