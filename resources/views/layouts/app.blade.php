<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aung Myin Clinic Manager</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/draggable.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}" />

    <script src="{{asset('js/iziToast.min.js') }}"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
      
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
    
      var pusher = new Pusher('4477b1080cfccdc685cf', {
        cluster: 'ap1'
      });
      var clinicId ={{ Session::get('cc_id') }};
      var userId = "<?php echo  Auth::guard('user')->user() ? Auth::guard('user')->user()['id'] : '0' ?>";
      var channel = pusher.subscribe('aungmyin_'+ clinicId + "_" + userId);
      channel.bind('notice', function(data) {
        var promise =   document.getElementById('myaudio').play();
        if (promise !== undefined) {
          promise.then(_ => {}).catch(error => {});}
        iziToast.show({
            position: 'topRight',
            titleColor: '#FFFFFF',
            messageColor: '#FFFFFF',
            timeout: 20000,
            backgroundColor: '#95bb72',        
            message: data.message
            });
      });
    </script>
</head>
<div class="middle">
    <div class="bar bar1"></div>
    <div class="bar bar2"></div>
    <div class="bar bar3"></div>
    <div class="bar bar4"></div>
    <div class="bar bar5"></div>
    <div class="bar bar6"></div>
    <div class="bar bar7"></div>
    <div class="bar bar8"></div>
</div>

@if(Request::is('clinic-system/*'))
@include('layouts.navbar')
@endif

@include('layouts.sidebar')

@yield('content')

@if(Request::is('clinic-system/*'))
@include('layouts.js')
@endif
