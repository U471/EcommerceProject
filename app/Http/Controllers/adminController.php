<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
class adminController extends Controller
{
    //
    function login(){
        return view('admin.login');
    }

  public function makeLogin(Request $request){
        $data=[
            'email'=>$request->email,
            'password'=>$request->password,
            'roll'=>'admin'
        ];
        if(Auth::attempt($data)){
            return redirect(url('admin/dashboard'));
        }else{
            return back()->withErrors(['message'=>'invalid email or password']);
        }
    }
  public function Dashboard(){
        return view('admin.Dashboard');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
