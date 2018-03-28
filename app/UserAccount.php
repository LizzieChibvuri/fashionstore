<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    //
     protected $fillable=['user_id','balance'];

     
     public function user()
     {
     	 return $this->belongsTo('App\User');
     }

     public function topups()
     {
     	 return $this->hasMany('App\Topup');
     }
}
