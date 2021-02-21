@extends('layouts.app')
@section('content')
<style>
  .dynamic{
    margin-right: 3px;
  }
  legend{
    border:1px solid gray;
    padding: 10px 10px;
  }
  .rd{
    transform: scale(1.8,1.8);
    width:25px;
  }
</style>
   <h2 class="text-center mt-3 mb-3">Add a Banner</h2>
   <hr>
   <div class="container mt-5">
	<form method="post" action="{{route('banners.store')}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="title_np">Title</label>	              
			<input type="text" id="title" class="form-control" placeholder="Title" name="title" required="required" value="{{old('title')}}">
		</div>
		<div class="form-group">
			<label for="title_en">Button title</label>	
			<input type="text" id="title_en" class="form-control" placeholder="Button title" name="btn_title"  value="{{old('btn_title')}}">
			
		</div>

		<div class="form-group">
			<label for="btn_link">Button link</label>	
			<input type="url" id="btn_link" class="form-control"  name="btn_link"  value="{{old('btn_link')}}">
			
		</div>

		<div class="form-group">
			<label for="photo">Photo</label>	        	    
			<input type="file" id="photo" class="form-control"  name="photo">
		</div>
		
		<div class="form-group">
			<label>Order</label>	        	    
			<input type="number" name="border" id="order" class="form-control" value="100">
		</div>
	<div class="form-group">
			<label>Status</label>	        	    
			<select name="status" class="form-control" id="">
				  <option value="1">Active</option>
				  <option value="0">Inactive</option>
			</select>
		</div>	
		  <button class="btn btn-primary btn-block" type="submit">Save</button>
		</form>


  
   </div>
@endsection
