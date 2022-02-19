<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tags::class,'product_tag','product_id','tag_id');
    }
    public function images(){
        return $this->belongsToMany(Image::class,'image_products');
    }
    public function attribute()
    {
        return $this->hasOne(Atributes::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }


}
