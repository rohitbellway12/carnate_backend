<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";

    protected $fillable = [
        'name',
        'lastname',
        'user_title',
        'birth_date',
        'email',
        'password',
        'mobile_no',
        'address',
        'country_id',
        'cust_type',
        'company_name',
        'state_id',
         'city_id',  
        'user_id',
         'pincode',
        'gst_number',
    ];
    public function user()
    {
        return $this->belongsTo(WorkShopVendor::class, 'user_id');
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'customer_id');
    }
    
    public function customerVehicles()
    {
        return $this->hasOne(Vehicle::class, 'customer_id');
    }
}
