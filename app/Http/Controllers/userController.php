<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    //
    public function index(){
        
     $users=User::get();
     return view('admin.user.index',compact('users'));
    }
    function destroy(Request $request){
        $id=$request->id;
        $users=User::find($id);
        $users->delete();
        return redirect()->route('User');
    }
}
