<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    //
     //
     protected $fillable=['useraccount_id','amount'];

     
     public function useraccount()
     {
     	 return $this->belongsTo('App\UserAccount');
     }
}
