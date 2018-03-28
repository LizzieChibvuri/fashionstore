<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index page is for normal users and should have user purchase history,accounts
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        return view('home')->with('orders',$user->orders);
    }

     public function admin()
    {
        //the admin page admin can  do products management
        $products=Product::orderby('created_at','desc')->get();

        return view('admin')->with('products',$products);

       
    }
}
