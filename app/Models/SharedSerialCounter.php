<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedSerialCounter extends Model
{
	use HasFactory;

	protected $table = 'shared_serial_counters';

	protected $fillable = [
		'workshop_id',
		'company_code',
		'series_code',
		'last_serial',
	];
}


