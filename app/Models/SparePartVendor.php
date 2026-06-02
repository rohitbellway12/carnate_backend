<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class SparePartVendor extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $guard_name = 'sparepart';

    protected $table = "spare_part_vendor";

    protected $fillable = ['status','online_stock_status','name','company_name','lastname','user_title','email','password','mobile_no','branch_name','birth_date','display_name','landline_no','country_id','state_id','city_id','address','image','user_type','parent_id','salary','monthly_target','incentives','joining_date','file','gst_number','pincode','branch_email','branch_number','tagline','branch_logo','branch_sign_logo','profile_update','is_gst'];

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    
    public function Role()
    {
        return $this->belongsTo( Role::class, 'user_type');
    }
    
    public function orderItems() {
         return $this->hasMany( OrderItem::class, 'user_id','id');
    }
    public function profileImage(){
        return $this->belongsTo(UploadImage::class,'branch_logo');
    }
    public function SignImage(){
        return $this->belongsTo(UploadImage::class,'branch_sign_logo');
    }
    
}
    