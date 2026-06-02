<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartSupplier extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_no',
        'business_first_name',
        'business_address',
        'gstin',
        'owner_first_name',
        'contact_1',
        'contact_2',
        'email',
    ];
}
