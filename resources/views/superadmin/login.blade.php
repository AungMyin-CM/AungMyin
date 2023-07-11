<<<<<<< HEAD
@extends('layouts.super_layout')

@section('content')

<div class="container col-sm-12 col-md-5" style="margin-top: 120px;">
    <div class="card shadow-sm bg-body rounded">
        <div class="rounded-top d-flex align-items-center justify-content-center gap-3 p-3" style="background-color: {{config('app.color')}}">
            <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="img-fluid" style="width: 50px;">
            <div class="text-white">
                <h3>Aung Myin</h3>
                <span style="font-size: 0.8rem;">Clinic Manager</span>
            </div>
        </div>
        <form action="{{ route('superadmin.login') }}" method="post" class="p-5">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="code" class="form-control" id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>

                @error('code') <span class="text-danger small">{{ $message }}</span>@enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>

                @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn px-4 text-white" style="background-color: {{config('app.color')}}">Login</button>
        </form>
    </div>
</div>

@endsection
=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aung Myin Clinic Manager</title>
    <!-- Icon -->
    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container col-sm-12 col-md-5" style="margin-top: 120px;">
        <div class="card shadow-sm bg-body rounded">
            <div class="rounded-top d-flex align-items-center justify-content-center gap-3 p-3" style="background-color: {{config('app.color')}}">
                <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="img-fluid" style="width: 50px;">
                <div class="text-white">
                    <h3>Aung Myin</h3>
                    <span style="font-size: 0.8rem;">Clinic Manager</span>
                </div>
            </div>
            <form action="{{ route('superadmin.login') }}" method="post" class="p-5">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="code" class="form-control" id="floatingInput" placeholder="Username">
                    <label for="floatingInput">Username</label>

                    @error('code') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>

                    @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn px-4 text-white" style="background-color: {{config('app.color')}}">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
>>>>>>> e6fda50 (feat: add superadmin login)
