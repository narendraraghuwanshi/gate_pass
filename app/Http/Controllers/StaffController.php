<?php

namespace App\Http\Controllers;

use App\TokenComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use App\Token;
use App\User;
use Auth;

class StaffController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->draw)){
            $tokens = Token::join('users','tokens.userId','Users.id')
                ->select(['tokens.id','users.name','users.mobile','tokens.isApprove','tokens.updated_at'])->orderBy('tokens.isApprove','DESC')
                ->where('tokens.staffId',Auth::id())
                ->orderBy('tokens.id','DESC');
            return Datatables::of($tokens)
                ->editColumn('isApprove', '{!!$isApprove==0?"No":"Yes"!!}')
                ->addColumn('option', function($data){
                    if($data->isApprove==0){return '<a href="'.route("staff.edit",$data->id).'" class="btn btn-sm btn-primary" title="View Detail"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-success" onclick="Approve('.$data->id.')" title="Approve this token"><i class="fa fa-check"></i></a>';}
                    else{return '<a href="'.route("staff.edit",$data->id).'" class="btn btn-sm btn-primary" title="View Detail"><i class="fa fa-eye"></i></a>';}
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('staff.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $token = Token::find($id);
        return view('staff.edit')->with('token',$token);
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
        $data = ['userId'=>Auth::id(),'tokenId'=>$id,'comment'=>$request->comment];
        if(TokenComment::firstOrCreate($data)){
            if($request->act=='Save and Back'){
                Session::flash('message', 'Your comment saved successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('staff.index');
            }else{
                Session::flash('message', 'Your comment saved successfully!');
                Session::flash('alert-class', 'alert-warning');
                return redirect()->back()->withInput();
            }
        }
        Session::flash('message', 'Your comment not saved! Please try again.');
        Session::flash('alert-class', 'alert-warning');
        return redirect()->back()->withInput();
    }

}
