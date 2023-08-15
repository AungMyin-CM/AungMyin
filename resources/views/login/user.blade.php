@extends('layouts.app')
@section('content')
<div class="login-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-5 ps-0 d-none d-md-block py-5 px-5" style="background-color: {{config('app.color')}}">
                            <div class="form-right  h-100  text-white text-center pt-5">
                                <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="brand-image">
                                <h2 class="fs-1">Aung Myin</h2>
                                <p class="fs-1">Clinic Manager</p>
                            </div>
                        </div>
                        @if (Session::has('success'))
                        @include('partials._toast')
                        @endif
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <h3 class="mb-3 text-center">Login</h3>

                                <form action="{{ route('login') }}" class="row g-4 mb-2" method="post">
                                    @csrf
                                    <div class="col-12 mb-1">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                                        </div>
                                        @error('email') <span class="text-danger small">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                            </div>
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-12 text-right mt-4">
                                        <a href="{{ route('password.request') }}" class="text-dark small mr-2">Forgot Password?</a>
                                        <button type="submit" class="btn px-4 float-end " style="color: {{config('app.secondary_color')}};background-color: {{config('app.color')}}">Login</button>
                                    </div>
                                </form>
                                <div class="card-footer text-muted text-center">
                                    New user?<a href="{{ route('register.user') }}" class="" style="color:  {{config('app.color')}}"> Create an account</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    // Alert Box
    setInterval(function() {
        $(".alert").fadeOut();
    }, 3000);

    $(document).ready(function() {
        $("input").keypress(function() {
            $("#alert-message").hide();
        });
    });
</script>