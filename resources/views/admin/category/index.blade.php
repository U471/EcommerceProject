@extends('admin.layout.layout');


@section('contant')
<table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Category Name</th>
      <th scope="col">Parent Category</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
     @foreach($categories as $key=>$category)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$category->name}}</td>
      <td>
         @if($category->parent)
         {{$category->parent->name}}
         @else
         No Parent Category
         @endif
        </td>
      <td>{{$category->created_at}}</td>
      <td><a href="{{route('category.edit',$category->id)}}" style="font-size: 17px;padding:5px;"><i class="fa fa-edit"></i></a></td>
      <td><a href="#" data-id="{{$category->id}}" class="category_delete" style="font-size: 17px;padding:5px;"><i class="fa fa-trash"></i></a></td>

    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@push('footer-script')
	<script>
		$('.category_delete').on('click',function(){
			if(confirm('Are you delete this category.')){
			var id = $(this).attr('data-id');
      console.log(id);
			$.ajax({
				url:'http://127.0.0.1:8000/category/delete',
				method:'post',
				data:{
				//	_token: "{{ csrf_token() }}",
					'id':id
				},
				success: function(data){
						location.reload();
				}
			});
		}
		});
	</script>
@endpush