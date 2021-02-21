@extends('layouts.app')
@section('content')
  <h2 class="m-3 text-center">Categories</h2>  
  <hr>
  @include('inc.messages')
   <div class="cotainer" >
 <div class="row" >
   
    <div class="col-lg-12 p-4 pr-5">
            <h4 class="mt-3 mb-3">Add new</h4>  
    <form action="{{url('addcategory')}}" method="post" enctype="multipart/form-data">
    <div class="form-group pr-5">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group pr-5">
      <label for="name">photo</label>
      <input type="file" name="pic" id="pic" class="form-control">
  </div>
    <div class="form-group pr-5">
            <label for="name">Parent</label>
            <select name="parent" id="" class="form-control">
                <option value="0">None</option>
                @if(count($categories)>0)
                @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            @endif
            </select>
        </div>
        @csrf
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
    </div>
      <div class="col-lg-12 p-5">
        <h4 class="mt-3 mb-3">&nbsp;</h4>
        <table class="table table-striped">
            <thead>
                <td>photo</td>
                <td>Name</td>
                <td>Slug</td>
                <td>parent</td>
                <td><i class="far fa-star"></i></td>
                <td>count</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </thead>
            <tbody>
                @if(count($categories)>0)
                  @foreach ($categories as $category)
                  <tr>
                  <td><img src="{{asset($category->photo ?? 'cats/no-img.jpg')}}" alt="{{$category->name}}" style="width: 60px;"></td>
                  <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->parent['name']}}</td>
                        <td >
                          <div class="spinner-grow" role="status" id='{{'sp-'.$category->id}}' style="display:none;">
                            <span class="sr-only">Loading...</span>
                          </div>
                        <i class="@if ($category->featured)fas @else far @endif fa-star text-primary" onclick="togglefeat({{$category->id}},this)" style="cursor: pointer;"></i>
                        
                        </td>
                        <td>{{count($category->products)}}</td>
                        <td><a href="{{url('/editcategory/'.$category->id)}}">Edit</a></td>
                  <td><form action="{{url('/delcategory')}}" method="post">
                    @csrf
                    {{method_field('delete')}}
                  <input type="hidden" name='id' value="{{$category->id}}">
                          <button type="submit"  class="btn-danger">Delete</a>
                        </form>
                    </td>
                    </tr>
                  @endforeach
              @else  
            
            @endif
            </tbody>
        </table> 
    </div>
  </div>
  </div>
@endsection
@section('scripts')
    <script>
      function togglefeat(id,v){
        console.log(id)
        let url="{{url('cattogglefeatured')}}";
        let sp='#sp-'+id;
        $(sp).show();
        $(v).hide();
        $.ajaxSetup({
	    headers: {
	    'X-CSRF-TOKEN': '{{csrf_token()}}'
	    }
	});
		  $.ajax({
		  type: 'POST',
		  url: url,
		  data: {
			pid:id
		   },
		  cache: false, 
		  success: function(response){ 
        console.log(response);
		    if(response.data=='200'){
        if($(v).hasClass('far')){
          $(v).removeClass('far');
          $(v).addClass('fas')
        }
        else{
          $(v).removeClass('fas');
          $(v).addClass('far')
        }} 
        $(v).show();
        $(sp).hide();
	    },
		catch :function(response){
		  alert('an error occured');
		 },
			
     
		//   },
		  dataType: 'json'
		  
	  });
    
      }
    </script>
@endsection