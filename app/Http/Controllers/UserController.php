<?php

namespace App\Http\Controllers;

use App\Role;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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
            $users = User::select('id','name','mobile','email');
            return Datatables::of($users)
                ->addColumn('role',function($data){
                    $role = ''; foreach($data->roles as $r)
                    {$role = $role.' <a class="btn btn-sm btn-success">'.$r->display_name.'</a>';}
                    return $role;
                })
                ->addColumn('option',function($data){
                    return "<a href='".route('user.show',$data->id)."' class='btn btn-sm btn-warning' title='View Detail'><i class='fa fa-eye'></i></a>
                            <a href='".route('user.edit',$data->id)."' class='btn btn-sm btn-primary' title='Edit user'><i class='fa fa-edit'></i></a>";
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::select('id','stateName')->get();
            $role = Role::select('id','name')->where('name', '!=' , 'visiter')->get();
        return view('admin.user.create')->with('states',$states)->with('roles',$role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','role');
        $password = str_random(8);
        $data['password'] = bcrypt($password);
        $data['name'] = $request->firstName . ' ' . $request->lastName;
        if($user = User::firstOrCreate($data))
        {
            $user->roles()->attach($request->role);
            Session::flash('message', 'User Create Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('user.index');
        }
        Session::flash('message', 'There are some problem! Try aftersome time');
        Session::flash('alert-class', 'alert-warning');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::select('id','stateName')->get();
        $role = Role::select('id','name','display_name')->where('name', '!=' , 'visiter')->get();
        $user = User::find($id);
        return view('admin.user.edit')->with('states',$states)->with('roles',$role)->with('user',$user);

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
        $user = User::find($id);
        $data = $request->except('_token','role','_method');
        $data['name'] = $request->firstName . ' ' . $request->lastName;
        $user->syncRoles($request->role);
        if($user = $user->update($data))
        {
//            $user->roles()->attach($request->role);
            Session::flash('message', 'User Update Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('user.index');
        }
        Session::flash('message', 'There are some problem! Try aftersome time');
        Session::flash('alert-class', 'alert-warning');
        return redirect()->back()->withInput();
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
