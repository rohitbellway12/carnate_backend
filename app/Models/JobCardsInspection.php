<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardsInspection extends Model
{
    use HasFactory;
 
    protected $fillable = ['jobcard_number','customer_voice','is_customer_voice','user_id'];
}
