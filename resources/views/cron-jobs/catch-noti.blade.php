<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/selectize.css') }}">


</head>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell noti-icon" id="noti-icon"></i>
                <span class="badge badge-warning navbar-badge noti-number"></span>
                <span hidden id="noti"></span>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="p_notis">
                <a class="dropdown-item" onclick="readAction(this)" id="patient_noti">
                    <!-- Message Start -->

                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                
                            </h3>
                            <ul class="list-unstyled">
                                <li><small class="text-muted" id="age"></small></li>
                                <li><small class="text-muted" id="gender"></small></li>
                            
                            </ul>
                            <p class="text-sm text-muted text-right"><i class="far fa-clock mr-1" id="time"></i></p>

                        </div>
                    </div>
            
                    <!-- Message End -->
                </a>

            </div>
        </li>            
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    
</script>
@include('layouts.js')
