<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $table = "upload_images";
    public $timestamps = true;
    protected $fillable = ['file','ext','img_id','delete_code','type'];
}
