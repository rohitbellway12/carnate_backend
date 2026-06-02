<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SparePart extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'spare_parts';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'user_id',
        'spare_part_type',
        'label_id',
        'brand',
        'price',
        'amount',
        'unit_id',
        'suitable_for',
        'discount',
        'stock',
        'description',
        'image',
        'purchase_price',
        'tax_type',
        'tax_percentage',
        'hsn_code',
        'rack_no',
        'category_id',
        'selling_amount',
        'discount_type',
        'platform_charge',
        'forAllVehicles',
         'part_number',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function label()
    {
        return $this->belongsTo(SparePartLabel::class,'label_id')->withTrashed();
    }

    public function Image()
    {
        return $this->belongsTo(UploadImage::class, 'image');
    }

    public function categorey()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function vendor()
    {
        return $this->belongsTo(SparePartVendor::class, 'user_id');
    }

    public function modifications(){
        return $this->hasMany(SparePartVehicleModification::class,'spare_part_id');
    }

}
