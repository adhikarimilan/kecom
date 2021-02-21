@extends('layout.app')
@section('content')
<div class="banner">
        <div class="container">
            <h1>Contact Us</h1>
        </div>
    </div>
        <div class="contact-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                    <form class="form" method="post" action="{{url('/contact')}}">
                        @csrf
                            <div class="form-row">
                                @if(session('success'))
                                    <div class="alert alert-success form-group col-12 text-center">Thank you for contacting us. We will get back to you soon :)</div>
                                @endif
                                @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger form-group col-12 text-center">
                                        {{$error}}
                                    </div>
                                @endforeach
                                @endif
                                <div class="form-group col-12">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{old('name')}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" required value="{{old('address')}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact">Contact No:</label>
                                    <input type="number" class="form-control" id="contact" name="contact" required value="{{old('contact')}}">
                                </div>
                                
                                <div class="form-group col-12">
                                    <label for="email">Email address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{old('email')}}">
                                </div>
                                <div class="form-group col-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required value="{{old('description')}}"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f3a49054c7806354da6eb87/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@endsection