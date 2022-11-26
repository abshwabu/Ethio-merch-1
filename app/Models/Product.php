<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function catagory()
    {
       return $this->belongsTo(Catagory::class,'category_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function attributes(){
        return $this->hasMany(ProductAttributes::class);
    }
    public function images(){
        return $this->hasMany(ProductImages::class);
    }
}
