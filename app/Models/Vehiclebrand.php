<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiclebrand extends Model
{
    //
    protected $table = 'vehicle_brands';

    protected $fillable = [
        'vehicle_type_id',  
        'vehicle_brand',  
    ];
    public function vehiclebrandtype()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'brand_id');
    }

}
