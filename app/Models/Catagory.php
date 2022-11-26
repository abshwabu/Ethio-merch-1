<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    protected $table = "catagories";
    // public function subcategories(){
    //     return $this->hasMany(Catagory::class,'parent_id')->where('status',1);
    //  }
     public function section(){
         return $this->belongsTo(Section::class,'section_id')->select('id','name');
     }
    //  public function parentcategory(){
    //      return $this->belongsTo(Catagory::class,'parent_id')->select('id','cate_name');
    //  }
}
