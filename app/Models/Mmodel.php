<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mmodel extends Model
{
    use HasFactory;

    protected $table = "models";

    protected $fillable = [
        'title',
		'maker_type_id',
		'maker_id',		
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
}
