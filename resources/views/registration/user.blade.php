@extends('layouts.app')
@section('content')

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>Registration </b><span id="clinicName">Form</span></a>
            </div>
            <div class="card">
                <div class="card-body register-card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <form action="{{ route('user.register') }}" method="POST">

                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name"
                                value="{{ old('name') }}" id="name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Username"
                                value="{{ old('code') }}" id="clinic_code">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Username is required</strong>
                                </span>
                                @enderror
                        </div>
                       
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"
                                value="{{ old('password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-eye"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="Phone Number" name="phoneNumber"
                                value={{ old('phoneNumber') }}>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phoneNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group">
                           
                                <div class="form-check  mr-3">
                                    <input class="form-check-input" id="male" type="radio"
                                        value="1" name="gender">
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" id="female" type="radio"
                                        value="0" name="gender">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div> 
                        </div>

                        <!-- /.col -->
                        <div class="col-4 float-right">
                            <button type="submit" id="register" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </form>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
        @extends('layouts.js')

        <!-- jQuery -->

    </body>
@endsection
