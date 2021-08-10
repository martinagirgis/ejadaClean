<!DOCTYPE html>
<html>

<head>
    <title>AutoBazar</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/martina/css/all.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Revalia' rel='stylesheet'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #007bff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

    </style>
</head>

<body>
@include('includes.nav')
<!-- profile -->
<div class="container">
    @yield('content')

</div>

<script type="text/javascript" src="{{asset('assets/site/js/jquery-3.3.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/js/slider_1_script.js')}}"></script>
<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
</body>

</html>
