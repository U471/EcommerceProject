<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\productDetail;
// use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Role::create(['name'=>'admin']);
        $products=product::get();
        return view('admin.product.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=category::whereNotNull('category_id')->get();
        return view('admin.product.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->hasFile('image')){
            $image=$request->file('image');
            $filename=date('dmy').time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path("/upload"),$filename);
            // $data[]=$filename;
        }
        $data=[
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'image'=>$filename
        ];
       
        $create=product::create($data);
        return redirect()->route('product.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,product $product)
    {
        //
        $id=$request->id;
        $categories=category::whereNotNull('category_id')->get();
        $products=product::findOrFail($id);
        return view('admin.product.edit',compact('categories','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
        $id=$request->id;
        $data=[
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->category_id
        ];
        if($request->hasFile('image')){
            $image=$request->file('image');
            $filename=date('dmy').time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path("/upload"),$filename);
            $data['image']=$filename;
        }
        $products=product::find($id);
       
        $products->update($data);
        return redirect()->route('product.list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,product $product)
    {
        //
        $id=$request->id;
        $products=product::find($id);
        $products->delete();
        return redirect()->route('product.list');
    }

    public function extraDetails(Request $request){
        $id=$request->id;
        $product=product::where('id',$id)->with('productDetail')->first();
        return view('admin.product.extraDetails',compact('id','product'));
    }

    public function extraDetailStore(Request $request){
       $data=[
           'product_id'=>$request->product_id,
           'tital'=>$request->tital,
           'total_item'=>$request->total_item,
           'description'=>$request->description,

       ];
       $detail=productDetail::updateOrCreate(
           ['product_id'=>$request->product_id],$data
       );
       return redirect()->route('product.list');
    }
}
