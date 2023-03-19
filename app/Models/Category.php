<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['category_name','user_id'];


    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
