<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable=['product_thumbnail_photo'];

    public function get_multiple_photos(){
        return $this->hasMany(Product_multiple_photo::class,'product_id','id');
    }
}
