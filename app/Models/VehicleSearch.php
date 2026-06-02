<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSearch extends Model
{
    use HasFactory;

    protected $table = "vehicle_searchs";

    protected $fillable = [
        'title',
		'maker_type_id',
		'maker_id',		
		'model_id',
		'model_year_id',
        'status', 
    ];   

    public function makerType()
    {
        return $this->belongsTo(MakerType::class, 'maker_type_id');
    }

    public function maker()
    {
        return $this->belongsTo(Maker::class, 'maker_id');
    }

    public function model()
    {
        return $this->belongsTo(Mmodel::class, 'model_id');
    }

    public function modelYear()
    {
        return $this->belongsTo(ModelYear::class, 'model_year_id');
    }
}
