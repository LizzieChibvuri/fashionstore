<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=['product_price','discount_amount','amount_paid'];


     public function product()
     {
     	 return $this->belongsTo('App\Product');
     }

       public function user()
     {
     	 return $this->belongsTo('App\User');
     }
}
