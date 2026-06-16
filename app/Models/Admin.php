<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory, Notifiable,HasRoles;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
            'user_title',
            'lastname',
            'mobile_no',
            'birth_date',
            'country_id',
            'state_id',
            'city_id',
            'address',
            'type',
            'parent_id',
            'role_type',
            'pincode',
            'gst_number',
        ];
    
        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];
    
        /**
         * Get the attributes that should be cast.
         *
         * @return array<string, string>
         */
        protected function casts(): array
        {
            return [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
            ];
        }
     // In App\Models\Admin.php
public function cityName()
{
    return $this->belongsTo(City::class, 'city_id');
}

public function stateName()
{
    return $this->belongsTo(State::class, 'state_id');
}

public function countryName()
{
    return $this->belongsTo(Country::class, 'country_id');
}
}
