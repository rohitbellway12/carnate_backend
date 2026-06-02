<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class PlanDescription extends Model
{
    use HasFactory;
 
    protected $appends = ['description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',  
        'plan_id',  
    ];
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
 
}
