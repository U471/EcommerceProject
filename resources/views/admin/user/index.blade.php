@extends('admin.layout.layout');


@section('contant')
<table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">create Date</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
     @foreach($users as $key=>$user)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->created_at}}</td>
      <td><a href="{{route('user.delete',$user->id)}}"  style="font-size: 17px;padding:5px;"><i class="fa fa-trash"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
