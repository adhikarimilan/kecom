 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kiran Bakery') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- Fonts 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <link rel="icon" href="{{asset('img/logo.png')}}">

    
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">-->

   

    
  
	<link rel="stylesheet" href="{{asset('css/font/flaticon.css')}}">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	

@yield('styles')
</head>
<body>
    <div id="app">
    @include('inc.navbar1')
   
    <div class="wrapping bg-light">
    @yield('content')
    </div>
    @include('inc.footer')
  
    <script src="https://kit.fontawesome.com/e61c5f7492.js" crossorigin="anonymous"></script>


  @yield('scripts')
</body>

</html>
