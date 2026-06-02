<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartVehicleModification extends Model
{
    use HasFactory;

    protected $table = "spare_part_vehicle_modifications";

    protected $fillable = [
        'spare_part_id',
		'vehicle_modification_id', 
    ];   

    public function modification(){
        return $this->belongsTo(Modification::class,'vehicle_modification_id');
    }

    
}
