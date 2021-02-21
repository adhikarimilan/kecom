@extends('layouts.app')
@section('content')
  <h2 class="m-3 text-center">Category</h2>  
  <hr>
  @include('inc.messages')
   <div class="cotainer" >
 <div class="row" >
   
    <div class="col-lg-12 p-4 pr-5">
            <h4 class="mt-3 mb-3">Edit Category</h4>  
    <form action="{{url('updatecategory')}}" method="post" enctype="multipart/form-data">
        
    <div class="form-group pr-5">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
    </div>
    <div class="form-group pr-5">
      <label for="name">change photo</label>
      <input type="file" name="pic" id="pic" class="form-control">
  </div>
  <div class="form-group pr-5">
    <label for="name">Preview photo</label><br>
    <img src="{{asset($category->photo ?? 'cats/no-img.jpg')}}" alt="{{$category->name}}" style="width: 60px;">
</div>
    <div class="form-group pr-5">
            <label for="name">Parent</label>
            <select name="parent" id="" class="form-control">
                <option value="0">None</option>
                @if(count($categories)>0)
                @foreach ($categories as $cat)
            <option value="{{$cat->id}}" @if ($category->parent && $category->parent->id==$cat->id)
              selected  
            @endif>{{$cat->name}}</option>
            @endforeach
            @endif
            </select>
        </div>
        <input type="hidden" name="id" value="{{$category->id}}">
        @csrf
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
    </div>
      
  </div>
  </div>
@endsection