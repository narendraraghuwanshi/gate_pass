<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // if(Auth::user()->hasRole('admin')){
       //     return view('home');
       // } else if(Auth::user()->hasRole('staff')) {
       // 		return view('home');
       // } else if(Auth::user()->hasRole('gatekeeper')) {
       // 		return view('home');
       // } else {
       // 		return view('home');
       // }

//        dd(Auth::user());
        // 
    }
}
