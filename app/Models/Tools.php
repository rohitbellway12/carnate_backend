<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Tools extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'spare_parts';
    protected $dates = ['deleted_at'];
    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
    ];

    // Relationships
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function label()
    {
        return $this->belongsTo(SparePartLabel::class, 'label_id');
    }

    public function Image()
    {
        return $this->belongsTo(UploadImage::class, 'image');
    }

    
    // Accessors
    public function getNameAttribute()
    {
        return $this->label ? $this->label->title : null;
    }
}
