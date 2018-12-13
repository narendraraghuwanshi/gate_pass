<?php

namespace App\Http\Controllers;

use App\State;
use App\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class GourdController extends Controller
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
                ->whereDate('tokens.created_at', Carbon::today())
                ->orderBy('tokens.id','DESC');
            return Datatables::of($tokens)
                ->editColumn('isApprove', function ($data){
                    if($data->isApprove==0){
                        return '<a class="btn btn-sm btn-warning">No</a>';
                    }else{
                        return '<a class="btn btn-sm btn-success">Yes</a>';
                    }
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('gourd.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = User::select('users.id','users.name')->join('role_user','role_user.user_id','users.id')->where('role_user.role_id',2)->get();
        $states = State::select('id','stateName')->get();
        return view('gourd.create')->with('staffs',$staffs)->with('states',$states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->except('_token','purpose','staffId');
        $user['name'] = $request->firstName .' ' .$request->lastName;
//        --------- Create a new user or update old -------------------
        $user = User::updateOrCreate($user);
        $password = str_random(8);
        $user->password = bcrypt($password);
//        -------------- Update Password -----------------------------
        $user->update();
        $token = $request->only('purpose','staffId');
        $token['userId'] = $user->id;
        $token = Token::create($token);
        $otp = rand(100000,999999);
        $message = urldecode('Token is generated. OTP is '.$otp.' your username is '.$user->mobile.' and password '.$password.' Login url '.url('user'));
        Session::put('otp',$otp);
        SendOtp($user->mobile,$message);

        return redirect()->route('gourd.edit',$token->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::where('mobile',$id)->first();
         if($user){
             return ['status'=>1,'data'=>$user];
         }else{
             return ['status'=>0];
         }
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
        return view('gourd.edit')->with('token',$token);
    }

    public function otp($id)
    {
        $token = Token::find($id);
        $otp = rand(100000,999999);
        $message = urldecode($otp.' is your one time password Please share this with gourd');
        Session::put('otp',$otp);
        SendOtp($token->user->mobile,$message);
        return ['status'=>1];
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
        if($request->otp==Session::get('otp'))
        {
            Session::flash('message', 'OTP verified, Please Wait for approval');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('gourd.index');
        }
        Session::flash('message', 'OTP is not verified! Try again');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
