<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public $table ='sections';
    protected $fillable = [
      'name',
      'status'  
    ];
    public function categories(){
      return $this->hasMany('App\Models\Catagory','section_id')->where('status' , 1);
    }
}
