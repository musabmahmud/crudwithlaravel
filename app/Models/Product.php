<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    function attribute(){
        return $this->belongsTo(Attribute::class,'product_id');
    }
}