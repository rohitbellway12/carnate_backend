<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    use HasFactory;


    protected $table = "makers";

    
    protected $fillable = [
        'title',
		'maker_type_id',	    
        'status', 
    ]; 

    public function makerType()
    {
        return $this->belongsTo(MakerType::class, 'maker_type_id');
    }
    
}
