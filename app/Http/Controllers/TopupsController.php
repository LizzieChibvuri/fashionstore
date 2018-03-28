<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topup;
use Session;
use App\User;

class TopupsController extends Controller
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
        //fetch all topups
        $userid=auth()->user()->id;
        $user=User::find($userid);
        $currentbalance=$user->useraccount['balance']; 
        $topups=Topup::orderby('created_at','desc')->get();

        //pass topups data to view
        return view('topups.index',['topups'=>$topups,'balance'=>$currentbalance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load create form
        return view('topups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get current user account
        $userid=auth()->user()->id;
        $user=User::find($userid);
        //validate topup data
        $this->validate($request,[ 
            'amount'=>'required',
            ]);

        //get topup data
        $topupData= new Topup;
        $topupData->useraccount_id=$user->useraccount['id'];       
        $topupData->amount=$request->input('amount');
      
        //insert topup dta
        $topupData->save();

        //store status message
        Session::flash('success_msg','topup added successfully');
        
        return redirect()->route('topups.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch topup data
        $topup=Topup::find($id);

        //pass data to details view
        return view('topups.details',['topup'=>$topup]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get topup data
        $topup=Topup::find($id);

        //load data in view
        return view('topups.edit',['topup'=>$topup]);
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
        $userid=auth()->user()->id;
        $useraccount=UserAccount::where('user_id',$userid)->first();
        //validate topup data
        $this->validate($request,[ 
            'amount'=>'required',
        ]);

        //get topup data
        $topupData= new Topup;
        $topupData->useraccount_id=$useraccount->id;       
        $topupData->amount=$request->input('amount');
      
        //insert topup dta
        $topupData->save();
       

        //store status message
        Session::flash('success_msg','topup updated  successfully');

        return redirect()->route('topups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        //delete topup dta
       $topupData=Topup::find($id);

       $topupData->delete();

        //store status message
        Session::flash('success_msg','topup deleted successfully');

        return redirect()->route('topups.index');
    }
}
