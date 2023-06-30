<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} - @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/css/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <script src="{{asset('assets/js/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

</head>

<body>
<!-- Sidenav -->
@include('dashboard.includes.sidebar')
<!-- Main content -->
<div class="main-content " id="panel">
    <!-- Topnav -->
  @include('dashboard.includes.top-nav')
    <!-- Header -->
    <!-- Header -->
   @include('dashboard.includes.header')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @yield('content')
        <!-- Footer -->
        @include('dashboard.includes.footer')
    </div>

</div>
<script src="{{asset('assets/js/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
</body>
</html>
