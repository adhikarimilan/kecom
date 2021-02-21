@extends('layouts.app')
@section('content')

   <h2 class="text-center mt-3 mb-3">Edit Banner</h2>
   <hr>
   <div class="container mt-5">
	<form method="post" action="{{route('banners.update',['banners'=>$banner->id])}}" enctype="multipart/form-data">
		@csrf
		{{method_field('PUT')}}
		<div class="form-group">
			<label for="Title_np">Title</label>             
			<input type="text" id="Title" class="form-control" placeholder="Title" name="title" required="required" value="{{$banner->title}}">
		</div>
		<div class="form-group">
			<label for="title_en">Button title</label>	
			<input type="text" id="title_en" class="form-control" placeholder="Button title" name="btn_title"  value="{{$banner->btn_title}}">
			
		</div>

		<div class="form-group">
			<label for="btn_link">Button link</label>	
			<input type="url" id="btn_link" class="form-control"  name="btn_link"  value="{{$banner->btn_link}}">
			
		</div>
		
		<div class="form-group">
			<label for="photo">Photo</label>	
			<img src="{{asset($banner->photo)}}" class="img-responsive" style="height:120px;padding:5px;">        	    
			<input type="file" id="photo" class="form-control" name="photo">
		</div>
		
		<div class="form-group">
			<label>Order</label>	        	    
		<input type="number" name="order" id="order" class="form-control" value="{{$banner->border}}">
		</div>
		
		<div class="form-group">
			<label>Status</label>	        	    
			<select name="status" class="form-control" id="">
				  <option value="1" {{$banner->status=="1"?'selected':''}}>Active</option>
				  <option value="0" {{$banner->status=="0"?'selected':''}}>Inactive</option>
			</select>
		</div>
		  <button class="btn btn-primary btn-block" type="submit">Save</button>
		</form>
   </div>
@endsection

