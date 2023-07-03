<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category=category::where('status','1')->get();
        return view('admin.category.index',['categories'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category=category::whereNull('category_id')->get();
        return view('admin.category.add',['categories'=>$category]);
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
        $data=[
            'name'=>$request->name,
            'category_id'=>$request->category_id, 
        ];
        $create=category::create($data);
        return redirect('/category/add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,category $category)
    {
        //
        $id=$request->id;
        $categories=category::whereNull('category_id')->get();
        $category=category::find($id);
        return view('admin.category.edit',compact('categories','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
        $id=$request->id;
        $data=[
            'name'=>$request->name,
            'category_id'=>$request->category_id, 
        ];
        $category=category::find($id);
        $category->update($data);
        return redirect()->route('category.list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,category $category)
    {
        //
        $id=$request->id;
        $category=category::find($id);
        $category->delete();
        // return redirect()->route('category.list');
        return response()->json('success');

    }
}
