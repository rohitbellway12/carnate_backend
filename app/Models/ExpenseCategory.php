<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $table = "expense_categories";

    protected $fillable = ['title'];
    public function user()
    {
        return $this->belongsTo(WorkShopVendor::class, 'user_id');
    }
}
