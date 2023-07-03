@extends('admin.layout.layout');


@section('contant')
<table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category Name</th>
      <th scope="col">price</th>
      <th scope="col">image</th>
      <th scope="col">Extra Details</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
     @foreach($products as $key=>$product)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$product->name}}</td>
      <td>
         @if($product->category)
         {{$product->category->name}}
         @endif
        </td>
      <td>{{$product->price}}</td>
      <td><img style="height:80px;width:80px;" src="{{asset('upload/'.$product->image)}}" alt=""></td>
      <td><button><a href="{{route('product.extraDetails',$product->id)}}">Add</a></button></td>
      <td><a href="{{route('product.edit',$product->id)}}" style="font-size: 17px;padding:5px;"><i class="fa fa-edit"></i></a></td>
      <td><a href="{{route('product.delete',$product->id)}}"  style="font-size: 17px;padding:5px;"><i class="fa fa-trash"></i></a></td>

    </tr>
    @endforeach
  </tbody>
</table>
@endsection
