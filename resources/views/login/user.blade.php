@extends('layouts.app')

@section('content')
    <body class="login-page">
        <div class="login-box row">
            <div class="card text-center">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post"> 
                        @csrf
                        <div>
                            <p class="h1">Login</p>
                        </div>
                        <div class="input-group mb-3 ">
                            <input type="text" class="form-control" placeholder="Username" name="code" value="{{ old('code') }}" required>
                                <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>
                        <div >
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>                             
                       
                    </form>
                </div>
                <div class="card-footer text-muted">
                  New user?<a href="{{ route('register.user') }}" class="text-center"> Create an account</a>
                </div>
              </div>
        </div>
    </body>
@endsection
