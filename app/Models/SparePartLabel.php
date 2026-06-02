<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SparePartLabel extends Model
{
    use HasFactory,SoftDeletes;
protected $fillable = ['title','spare_part_type'];
    protected $dates = ['deleted_at'];

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class, 'label_id');
    }
    public function sparePartStocks()
    {
        return $this->hasMany(SparePart::class, 'label_id');
    }

    public function user(){
        return $this->belongsTo(WorkShopVendor::class,'user_id');
    }
}
