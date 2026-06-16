<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class WorkShopVendor extends Authenticatable
{
    use HasFactory, HasRoles, HasApiTokens, Notifiable;
    protected $guard_name = 'web';

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = "work_shop_vendor";

    protected $fillable = ['name', 'company_name','image','is_login','lastname', 'user_title', 'email', 'password', 'mobile_no', 'birth_date', 'branch_name', 'display_name', 'landline_no', 'country_id', 'state_id', 'city_id', 'address', 'type', 'parent_id', 'branch_email', 'branch_number', 'is_trial', 'trial_days', 'branch_logo', 'trial_start_date', 'profile_update', 'is_subscribe', 'subscription_start_date', 'subscription_end_date', 'salary', 'monthly_target', 'incentives', 'joining_date', 'user_type', 'is_user', 'gst', 'file', 'pincode', 'branch_sign_logo', 'tagline','is_gst'];

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Add this relationship
    public function stateName()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    // Add this relationship
    public function countryName()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'user_type');
    }

    public function Image()
    {
        return $this->belongsTo(UploadImage::class, 'branch_logo');
    }

    public function parent()
    {
        return $this->belongsTo(WorkShopVendor::class, 'parent_id');
    }
    
    public function SignImage()
    {
        return $this->belongsTo(UploadImage::class, 'branch_sign_logo');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}