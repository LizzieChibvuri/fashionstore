<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;
use App\UserAccount;
use Session;

class OrdersController extends Controller
{
    //
     /**
     * Create a new controller instance.
       except is to specify routes that are not authenticated
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all orders
        $orders=Order::orderby('created_at','desc')->get();

        //pass orders data to view
        return view('orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load create form
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user_id=auth()->user()->id;
        $account=UserAccount::where('user_id',$user_id)->first();
    	
    
       //$userbalance=$account->balance;

        //validate order data
        $this->validate($request,[ 
            'product_id'=>'required',
            'product_price'=>'required',
            'discount'=>'required',
            'discount_amount'=>'required',
            'amount_due'=>'required',
            ]);
        
            //check if  user has enaf balance
        	//get order data
	        $orderData= new Order;

            if($account->balance>=$request->input('product_price'))
            {
	        //$orderData=$request->all();
	        $orderData->product_id=$request->input('product_id');       
	        $orderData->product_price=$request->input('product_price');
	        $orderData->discount_amount=$request->input('discount_amount');
	        $orderData->amount_paid=$request->input('amount_due');
	        $orderData->user_id=$user_id;

	        //insert order dta
	       //order::create($orderData);
	        $orderData->save();

	        //store status message
	        Session::flash('success_msg','Order successfull,thank you for shopping with us!');

            }
            else
            {

            //store status message
            Session::flash('error_msg','Insufficient funds,please topup your account!');

            }


        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch order data
        $order=Order::find($id);

        //pass data to details view
        return view('orders.details',['order'=>$order]);

    }

    public function userorders()
    {
    	$user_id=auth()->user()->id;
        $user=User::find($user_id);
        return view('orders.index')->with('orders',$user->orders);
        //fetch order data
      }

    public function buyproduct($id)
    {

        //fetch order data
        $product=Product::find($id);
        $discountamount=$product->price*$product->discount;
        $amountdue=$product->price-$discountamount;

        $data=array('discountamount'=>$discountamount,'amountdue'=>$amountdue,
                    'product'=>$product);

        //pass data to details view
        return view('orders.create')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get order data
        $order=Order::find($id);

        //load data in view
        return view('orders.edit',['order'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          //validate order data
             //validate order data
        $this->validate($request,[ 
            'product_id'=>'required',
            'product_price'=>'required',
            'discount'=>'required',
            ]);

        $discount_amount=$request->input('product_price')*$request->input('discount');
        $amount_paid=$request->input('product_price')-$discount_amount;


        //get order data
        $orderData= new Order;
        //$orderData=$request->all();
        $orderData->product_id=$request->input('product_id');       
        $orderData->product_price=$request->input('product_price');
        $orderData->discount_amount=$discount_amount; 
        $orderData->amount_paid=$amount_paid;
        $orderData->user_id=auth()->user()->id;
      
        //update order dta
       $orderData->save();

        //store status message
        Session::flash('success_msg','order updated  successfully');

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        //delete order dta
       $orderData=Order::find($id);

       $orderData->delete();

        //store status message
        Session::flash('success_msg','order deleted successfully');

        return redirect()->route('orders.index');
    }
}
