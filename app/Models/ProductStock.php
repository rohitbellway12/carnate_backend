<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use HasFactory, SoftDeletes;
     protected $dates = ['deleted_at']; 
    protected $table = 'stocks';
    
    protected $fillable = [
        'label_id',
        'category_id',
        'supplier_id',
        'stock',
        'price',
        'user_id',
        'buy_price',
        'brand',
        'tax_type',
        'tax_percentage',
        'unit_id',
        'hsn_code',
        'self_stock',
        'categories_id',
        'part_number',
        'rack_no',
        'forAllVehicles',
        'sp_type',
    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
 
    protected $appends = ['title','category'];
    protected $hidden = ['label'];

    public function label()
    {
        return $this->belongsTo(SparePartLabel::class,'label_id')->withTrashed();
    }
    
    public function categories()
    {
        return $this->belongsTo(Category::class,'categories_id')->select('id','title');
    }
    
    public function unit()
        {
            return $this->belongsTo(Unit::class, 'unit_id')->select('id','title');
        }

   
    public function getTitleAttribute()
    {
        return $this->label ? $this->label->title : null;
    }
    
    
    public function getCategoryAttribute()
    {
        switch ($this->category_id) {
            case '1':
                $category = 'Accessory';
                break;
            case '2':
                $category = 'Parts';
                break;
            case '3':
                $category = 'Tools';
                break;
            case '4':
                $category = 'Lubricant';
                break;
            default:
                $category = null;
                break;
        }
        return $category;
    }
}

