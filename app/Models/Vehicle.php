<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{ 
    //For 
    protected $table = 'vehicles';


    public function notes()
    {
        return $this->morphMany(Notes::class, 'entity', 'entity_type', 'entity_id');
    }

    public function brand()
    {
        return $this->belongsTo(Vehiclebrand::class, 'vehiclebrand_id');
    }
    public function vehicleuser()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function vehicletype()
    {
        return $this->belongsTo(VehicleType::class, 'vehicletype_id');
    }
    public function vehicleimage()
    {
        return $this->belongsTo(VehicleImages::class, 'vehicle_id');
    }
}
