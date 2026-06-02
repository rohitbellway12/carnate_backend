<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Model
{
    use HasFactory,HasRoles;

    protected $guard_name = 'web';
    protected $table = "staffes";

    protected $fillable = [
        'name',
        'lastname',
        'gender',
        'email',
        'password',
        'mobile_no',
        'branch_name',
        'landline_no',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'birth_date',
        'display_name',
        'parent_id',
        'role',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
