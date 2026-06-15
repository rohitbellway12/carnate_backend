<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

	protected $table = 'expenses';

	protected $fillable = ['category_id', 'parent_id', 'supplier_id', 'bill_number', 'date', 'total_amount', 'paid_amount', 'balance_amount', 'description'];

	public function category(){
		return $this->belongsTo(ExpenseCategory::class,'category_id');
	}
// 	public function supplier(){
// 		return $this->belongsTo(WorkShopVendor::class,'parent_id');
// 	}
	
    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }

    public function workshopSupplier(){
        return $this->belongsTo(WorkshopSupplier::class,'supplier_id');
    }

    public function sparePartSupplier(){
        return $this->belongsTo(SparePartSupplier::class,'supplier_id');
    }

    public function sparePartCategory(){
        return $this->belongsTo(SparePartExpenseCategory::class,'category_id');
    }

    public function workshopCategory(){
        return $this->belongsTo(WorkshopExpenseCategory::class,'category_id');
    }
}
