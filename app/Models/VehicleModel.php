<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{ 
    protected $table = 'model_names';

    protected $fillable = [
        'brand_id',  
        'model_name',  
    ];
    public function vehiclebrand()
    {
        return $this->belongsTo(Vehiclebrand::class, 'brand_id');
    }

    public function brand()
    {
        return $this->belongsTo(Vehiclebrand::class, 'brand_id');
    }

}
