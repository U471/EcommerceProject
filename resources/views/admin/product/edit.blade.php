@extends('admin.layout.layout');


@section('contant')
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Design <small>different form elements</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2"  action="{{route('product.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                     @csrf
                     <input type="hidden" name="id" value="{{$products->id}}">
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            
                            <select  name="category_id" class="form-control col-md-7 col-xs-12">
                               <option value="">Category Name</option>
                               @foreach($categories as $categorie) 
                               <option value="{{$categorie->id}}" @if($products->category_id==$categorie->id) selected @endif>{{$categorie->name}}</option> 
                               @endforeach
                            </select>
                            
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Products Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="{{$products->name}}" name="name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" value="{{$products->price}}" name="price" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file"  name="image"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12"></div>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <img style="height:80px;width:80px;" src="{{asset('upload/'.$products->image)}}" alt="">
                           </div>
                      </div>
                     
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection