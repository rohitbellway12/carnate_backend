<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'jobcard_number',
        'shared_serial',
        'customer_id',
        'vehicle_id',
        'amount',
        'discount',
        'final_amount',
        'advance',
        'balance_amount',
        'final_discount',
        'final_paid',
        'km_runing',
        'fual_level',
        'supervisor_id',
        'delivery_date',
        'delivery_time',
        'payment_type',
        'transaction_number',
        'status',
        'step',
        'sms_alert',
        'user_id',
        'notes',
        'soft_delete',
        'deleted_at',
    ];
    public function jobCardSpareParts()
    {
        return $this->hasMany(JobCardSparePart::class, 'jobcard_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }


    public function exitNote()
    {
        return $this->hasOne(ExitNote::class);
    }
    public function labours()
    {
        return $this->hasMany(\App\Models\JobCardExtraCharge::class, 'jobcard_id');
    }

    public function workshop()
    {
        return $this->belongsTo(WorkShopVendor::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(JobCardPayment::class, 'job_card_id');
    }
}
