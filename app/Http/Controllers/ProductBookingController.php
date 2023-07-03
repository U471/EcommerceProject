<?php

namespace App\Http\Controllers;

use App\Models\productBooking;
use Illuminate\Http\Request;
use App\Models\cart;
use Illuminate\Support\Facades\Session;

use Omnipay\Omnipay;

class ProductBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart_id=$request->cart;
        $data=[];
        $totalAmount=0;
        foreach($cart_id as $i=>$value){
             $cart=cart::find($value);
             $amount=$cart->qty * $cart->product->price;
             $totalAmount=$totalAmount + $amount;
             $data[$i]['user_id']=$cart->user_id;
             $data[$i]['product_id']=$cart->product_id;
             $data[$i]['qty']=$cart->qty;
             $data[$i]['payment_status']='0';


        }
        $productBooking=productBooking::insert($data);
        $bookid=productBooking::orderBy('id','desc')->take(count($data))->pluk('id');
        if($productBooking){
            cart::destroy($cart_id);
            if($request->payment_type == 'eway'){
                session::put('bookId',$bookid);
                $url=$this->ewayPayment($totalAmount);
                return response()->json(['type'=>'eway','url'=>$url]);
            }else{
                 
            }
        }
    }

    public function ewayPayment($amount){
            $totalAmount=$amount;
            $apiKey = 'F9802C2/10UYFWAd2Touhqh1PZtNJA5M7PCXU21bgDoCRQzG0cxhGbFO6+YYwFHgLOprbi';
            $apiPassword = 'zvmKw3Fy';
            $apiEndpoint = 'Sandbox'; // Use \Eway\Rapid\Client::MODE_PRODUCTION when you go live
            $client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);

            $transaction = [
                'RedirectUrl' => route('bookingSuccess'),
                'CancelUrl' =>route('bookingFail'),
                'TransactionType' => \Eway\Rapid\Enum\TransactionType::PURCHASE,
                'Payment' => [
                    'TotalAmount' =>$totalAmount,
                ],
            ];  
            $response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::TRANSPARENT_REDIRECT, $transaction);
                 $sharedUrl='';
            if (!$response->getErrors()) {
                $sharedUrl = $response->SharedPaymentUrl;
               
            } 
            return $sharedUrl;
      }

      public function bookingFail(){
      session::forget('bookId');
      return redirect()->route('cart');
      }
      public function bookingSuccess(){  
        $bookId= session::get('bookId');
        productBooking::whereIn('id',$bookId)->update(['payment_status'=>'1']);
        session::forget('bookId');
        return redirect()->route('cart');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function show(productBooking $productBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(productBooking $productBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productBooking $productBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(productBooking $productBooking)
    {
        //
    }
}
