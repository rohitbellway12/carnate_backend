<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    use HasFactory;
 
    protected $appends = ['plan_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_name', 
        'validity', 
        'amount', 
        'description', 
        'is_trial', 
        'status',  
        'plan_type',  
        'days',
    ];

    public function planDescriptions()
{
    return $this->hasMany(PlanDescription::class, 'plan_id');
}

 
}
