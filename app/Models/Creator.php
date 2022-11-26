<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'media_url',
        'phone_number',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function payment(){
        return $this->hasMany(CreatorPaymentData::class);
    }
    public function designs(){
        return $this->hasMany(Design::class,'creator_id');
    }
}
