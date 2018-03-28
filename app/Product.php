<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //fillable fields
     protected $fillable=['name','price','category','stocklevel'];

     public function orders()
     {
     	 return $this->hasMany('App\Order');
     }
}
