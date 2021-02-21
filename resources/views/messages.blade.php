@extends('layouts.app')
@section('content')
<style>
.notseen{
    padding:20px;
    background-color:rgba(120,120,0,0.5)!important;
    color:black;
    cursor: pointer;
}
.seen{
    padding:20px;
    border:1px solid rgba(120,120,0,0.5);
    color:black;
    cursor: pointer;
}

a:hover{
    text-decoration: none;
}
</style>
<h3 class="text-center m-2">Messages from Users</h3>
<hr>
@if(isset($msgs))

<div class="container mt-5">
        <div class="row text-info">
                <h3 class="col-md-6">{{$unseen}} unread messages</h3>
                <h3 class="col-md-6 text-right">{{count($msgs)}} Total messages</h3>
                </div>   
@foreach($msgs as $msg)
            <div class="text-center mb-1 {{$msg->seen?'seen':'notseen'}}" onclick="window.location.href = {{url('message/'.$msg->id)}};">
    
   <a href="{{url('message/'.$msg->id)}}"> <h4>{{strlen($msg->description) > 50 ? substr($msg->description,0,50)."..." : $msg->description}}</h4></a>
<h5>by {{$msg->name}} . {{time_date_diff($msg->created_at)}}</h5>
</div>
@endforeach
</div>
@endif
@endsection