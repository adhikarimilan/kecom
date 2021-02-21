@extends('layouts.app')
@section('contents')
<div class="row">
    <div class="col-sm-12">
        <div class="main-card card p-3">
            <div>
              <h3 class="box-title pull-left">All Banners</h3>
              <a href="{{route('banners.create')}}" class="btn btn-success pull-right">Add New Banner</a>
              <div class="clearfix"></div>
            </div>
            @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{Session::get('msg')}}
            </div>
            @endif
            <div class="table-responsive">
              <table class="table table-bordered" id="staffs" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>                       
                    <th>Status</th>               
                    <th>Action</th>
                  </tr>
                </thead>        
                <tbody>
                @if($banners->count()>0)
                @foreach($banners as $banner)
                <tr>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->description}}</td>                  
                  <td><img src="{{asset($banner->photo)}}" style="width:100px;"></td>
                  <td>{{$banner->status=="1"?"active":"inactive"}}</td>
                  <td>
                    <a href="{{route('banners.edit',['banners'=>$banner->id])}}" class="btn btn-info">Edit</a>
                    <form id="delete-form-{{$banner->id}}" action="{{route('banners.destroy',['banners'=>$banner->id])}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                    </form>                     
                    <a class="btn btn-danger" href="{{route('banners.destroy',['banners'=>$banner->id])}}" onclick="event.preventDefault();document.getElementById('delete-form-{{$banner->id}}').submit();">Delete</a>
                    
                  </td>
                </tr>
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
 <script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
@include('inc.messages')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Banners</h1>
        <a href="{{route('banners.create')}}" class="btn btn-primary mb-2">Add new</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>                       
                    <th>Status</th>               
                    <th>Action</th>
                  </tr>
                </thead>        
                <tbody>
                @if($banners->count()>0)
                @foreach($banners as $banner)
                <tr>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->description}}</td>                  
                  <td><img src="{{asset($banner->photo)}}" style="width:100px;"></td>
                  <td>{{$banner->status=="1"?"active":"inactive"}}</td>
                  <td>
                    <a href="{{route('banners.edit',['banners'=>$banner->id])}}" class="btn btn-info">Edit</a>
                    <form id="delete-form-{{$banner->id}}" action="{{route('banners.destroy',['banners'=>$banner->id])}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                    </form>                     
                    <a class="btn btn-danger" href="{{route('banners.destroy',['banners'=>$banner->id])}}" onclick="event.preventDefault();document.getElementById('delete-form-{{$banner->id}}').submit();">Delete</a>
                    
                  </td>
                </tr>
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
           
          </div>
        </div>

      </div>

@endsection


