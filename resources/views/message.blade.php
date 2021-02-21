@extends('layouts.app')
@section('content')
<h2 class="text-center m-3">View Message</h2>
<hr>
@if(isset($mes))
<div class="container">
    <h4>Sent by: {{$mes->name}}</h4>
    <h4>Address: {{$mes->address}}</h4>
<h4>Mobile: {{$mes->contact}}</h4>
<h4>Email: {{$mes->email}}</h4>
<h5>Description:</h5>
<p>{{$mes->description}}</p>
</div>
@endif
@endsection