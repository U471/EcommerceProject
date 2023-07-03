@extends('front.layout.layout');
@section('contant')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3>Login</h3>	
	<div class="well">
		@if($errors->any())
		  <div class="alert alert-danger">
              @foreach($errors->all() as $error)
			  <li>{{$error}}</li>
			  @endforeach
		  </div>
		@endif
    <form class="form-horizontal" action="{{route('loginCheck')}}" method="post" >
        @csrf
    <div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" id="input_email" name="email" placeholder="Email" required>
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" id="inputPassword1" name="password" placeholder="Password" required>
		</div>
	  </div>
      <div class="control-group">
            <div class="controls">
               <input class="btn btn-large btn-success" type="submit" value="Login">
            </div>
          </div>

    </form>
    </div>
    <h3> Registration</h3>	
	<div class="well">
	<form class="form-horizontal" action="{{route('userStore')}}" method="post" >
        @csrf
		<div class="control-group">
			<label class="control-label" for="inputFname1">First name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="inputFname1" name="first_name" placeholder="First Name" required>
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="inputLnam" name="last_name" placeholder="Last Name" required>
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" id="input_email" name="email" placeholder="Email" required>
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		   <input type="password" id="inputPassword1" name="password" placeholder="Password" required>
		</div>
	  </div>	  
	   <div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-success" type="submit" value="Register" />
			</div>
		</div>		
	</form>
</div>
</div>
@endsection
