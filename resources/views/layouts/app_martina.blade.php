<!DOCTYPE html>
<html>
<head>
    <title>AutoBazar</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/all.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Revalia' rel='stylesheet'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
@include('includes.nav')

<!-- sign In -->

@yield('content')


<script type="text/javascript" src="{{asset('assets/site/martina/js/jquery-3.3.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/martina/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/martina/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src={{asset('assets/site/martina/js/script.js')}}""></script>

</body>
</html>
