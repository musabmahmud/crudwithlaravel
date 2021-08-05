<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Size extends Model
{
    use HasFactory,SoftDeletes;
    function product(){
        return $this->hasMany(Product::class,'product_id');
    }
    function attribute(){
        return $this->hasMany(Attribute::class,'size_id');
    }
}
