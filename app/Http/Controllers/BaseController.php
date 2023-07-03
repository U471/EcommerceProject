<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
// use Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BaseController extends Controller
{
    //
    public function home(){
        $products=product::get();
        $newProducts=product::limit(6)->latest()->get();
        return view('front.home',compact('products','newProducts'));
    }
    public function specialsOffer(){
        return view('front.specialsOffer');
    }
    public function delivery(){
        return view('front.delivery');
    }
    public function contact(){
        return view('front.contact');
    }
    public function cart(){
        $carts=[];
        if(Auth::user()){
          $user_id=Auth::user()->id;
          $carts=cart::where('user_id',$user_id)->latest()->get();
        }
        return view('front.cart',compact('carts'));
    }
    public function productView(Request $request){
        $id=$request->id;
        $product=product::where('id',$id)->with('productDetail')->first();
        $category_id=$product->category_id;
        $related_product=product::where('category_id',$category_id)->get();
        return view('front.productView',compact('product','related_product'));
    }

    public function userLogin(){
        return view('front.login');
    }

    public function loginCheck(Request $request){
        $data=[
            'email'=>$request->email,
            'password'=>$request->password,
            'roll'=>'user'
        ];
        if(Auth::attempt($data)){
            return redirect(url('/home'));
        }else{
            return back()->withErrors(['message'=>'invalid email or password']);
        }
    }

    public function userStore(Request $request){
       
        $data=[
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'roll' =>'user'
        ];
        $user=user::create($data);
        return redirect()->route('userLogin');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('userLogin');
    }
}
