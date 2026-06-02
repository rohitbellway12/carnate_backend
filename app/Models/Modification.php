<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    use HasFactory;

    protected $table = "modifications";

    protected $fillable = [
        'title',
        'brand_id',
        'brand_name',
        'variant_id',
        'variant_name',
        'year',
        'fuel_type',
        'engine_name',
        'status',
    ];

    public function brand()
    {
        return $this->belongsTo(MakerType::class, 'brand_id');
    }

    public function variant()
    {
        return $this->belongsTo(Maker::class, 'variant_id');
    }

    public function year()
    {
        return $this->belongsTo(ModelYear::class, 'year');
    }
}
