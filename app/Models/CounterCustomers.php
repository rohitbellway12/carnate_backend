<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterCustomers extends Model
{
    use HasFactory;
    protected $table = "counter_customers";

    protected $fillable = [
        'name', 
        'email', 
        'mobile_no',
        'address', 
        'number_plate',
        'gst_number', 
    ]; 
}
