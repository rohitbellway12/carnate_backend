<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
class Subscription extends Model
{
    use HasFactory; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',  
        'plan_id',  
        'payment_id',  
        'plan_name',  
        'amount',  
        'plan_type',  
    ]; 
 
}
