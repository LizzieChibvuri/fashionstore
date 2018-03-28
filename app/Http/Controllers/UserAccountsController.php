<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAccount;
use Session;

class UserAccountsController extends Controller
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
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all useraccounts
        $useraccounts=useraccount::orderby('created_at','desc')->get();

        //pass useraccounts data to view
        return view('useraccounts.index',['useraccounts'=>$useraccounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load create form
        return view('useraccounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate useraccount data
        $this->validate($request,[ 
            'name'=>'required',
            'price'=>'required',
            'category'=>'required',
            'stocklevel'=>'required',
            'useraccount_image'=>'image|nullable|max:1999'
            ]);

        //handle file uploads
        if($request->hasFile('useraccount_image'))
        {
            //get file name with extension
            $filenamewithExt=$request->file('useraccount_image')->getClientOriginalName();
            //get filename only
            $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //get extension only
            $extension=$request->file('useraccount_image')->getClientOriginalExtension();
            $filenameToDB=$filename.'_'.time().'_'.$extension;
            $path=$request->file('useraccount_image')->storeAs('public/useraccount_photos',$filenameToDB);

        }
        else{

            $filenameToDB='noimage.jpg';
        }


        //get useraccount data
        $useraccountData= new useraccount;
        //$useraccountData=$request->all();
        $useraccountData->name=$request->input('name');       
        $useraccountData->price=$request->input('price');
        $useraccountData->category=$request->input('category');       
        $useraccountData->stocklevel=$request->input('stocklevel');
        $useraccountData->useraccount_image=$filenameToDB;
        //$useraccountData->user_id=auth()->user()->id;

        //insert useraccount dta
       //useraccount::create($useraccountData);
        $useraccountData->save();

        //store status message
        Session::flash('success_msg','useraccount added successfully');

        return redirect()->route('useraccounts.index');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch useraccount data
        $useraccount=useraccount::find($id);

        //pass data to details view
        return view('useraccounts.details',['useraccount'=>$useraccount]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get useraccount data
        $useraccount=useraccount::find($id);

        //load data in view
        return view('useraccounts.edit',['useraccount'=>$useraccount]);
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
          //validate useraccount data
        $this->validate($request,[ 
            'name'=>'required',
            'price'=>'required',
            'category'=>'required',
            'stocklevel'=>'required',
            'useraccount_image'=>'image|nullable|max:1999'
            ]);

             //handle file uploads
        if($request->hasFile('useraccount_image'))
        {
            //get file name with extension
            $filenamewithExt=$request->file('useraccount_image')->getClientOriginalName();
            //get filename only
            $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //get extension only
            $extension=$request->file('useraccount_image')->getClientOriginalExtension();
            $filenameToDB=$filename.'_'.time().'_'.$extension;
            $path=$request->file('useraccount_image')->storeAs('public/useraccount_photos',$filenameToDB);

        }
    

        
        //get useraccount data
        $useraccountData= useraccount::find($id);
        $useraccountData->name=$request->input('name');       
        $useraccountData->price=$request->input('price');
        $useraccountData->category=$request->input('category');       
        $useraccountData->stocklevel=$request->input('stocklevel');
        if($request->hasFile('useraccount_image'))
        {
            $useraccountData->useraccount_image=$filenameToDB;
        }
      

        //update useraccount dta
       $useraccountData->save();

        //store status message
        Session::flash('success_msg','useraccount updated  successfully');

        return redirect()->route('useraccounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        //delete useraccount dta
       $useraccountData=useraccount::find($id);

       if($useraccountData->photo_image!='noimage.jpg')
       {
            //delete image from store
            Storage::delete('public/useraccount_photos/'.$useraccountData->useraccount_image);

       }

       $useraccountData->delete();

        //store status message
        Session::flash('success_msg','useraccount deleted successfully');

        return redirect()->route('useraccounts.index');
    }
}
