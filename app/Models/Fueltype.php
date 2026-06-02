<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fueltype extends Model
{ 
    protected $table = 'fuel_types';
 
    protected $fillable = [
        'fuel_type',   
    ];
}
