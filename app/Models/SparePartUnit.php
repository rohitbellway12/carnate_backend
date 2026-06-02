<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartUnit extends Model
{
    use HasFactory;
    protected $table = "units";

    protected $fillable = ['title'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(WorkShopVendor::class, 'user_id');
    }
}
