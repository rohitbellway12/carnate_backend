<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class JobCardImage extends Model
{
    use HasFactory;
 
    protected $fillable = ['job_card_number','image_id'];

    public function Images()
    {
        return $this->hasMany(UploadImage::class, 'id', 'image_id'); // Adjust the foreign and local key if needed
    }
}
