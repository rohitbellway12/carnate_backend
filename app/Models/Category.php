<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'title', 
        'user_id', 
        'image_id', 
    ]; 
    
    public function Image()
    {
        return $this->belongsTo(UploadImage::class, 'image_id');
    }
}
