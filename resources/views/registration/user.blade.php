@extends('layouts.app')
@section('content')

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>Registration </b><span id="clinicName">Form</span></a>
            </div>
            <div class="card">
                <div class="card-body register-card-body">
                   
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
                                <span class="invalid-feedback" role="alert" id="alert-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Username"
                                value="{{ old('code') }}" id="username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-circle hover" id="uc_icon" data-toggle="tooltip" data-placement="top"></span>
                                    </div>
                                </div>
                                @error('code')
                                    <span class="invalid-feedback" role="alert" id="alert-message">
                                        <strong>Username is required</strong>
                                    </span>
                                    
                                @enderror
                        </div>
                       
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"
                                value="{{ old('email') }}" id="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope hover" id="en_icon" data-toggle="tooltip" data-placement="top"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert" id="alert-message">
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
                                <span class="invalid-feedback" role="alert" id="alert-message">
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
                                <span class="invalid-feedback" role="alert" id="alert-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                    <select name="" id="" class="form-input">
                                        <option value="mm">+95 (MM)</option>
                                    </select>
                            </div>
                            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="09xxxxxxxx" name="phoneNumber"
                                value={{ old('phoneNumber') }}>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phoneNumber')
                            <span class="invalid-feedback" role="alert" id="alert-message">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- <div class="input-group">
                           
                                <div class="form-check  mr-3">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" id="male" type="radio"
                                        value="1" name="gender">
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                    
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" id="female" type="radio"
                                        value="0" name="gender">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                    
                                </div> 
                                @error('gender')
                                <span class="invalid-feedback" role="alert" id="alert-message">
                                    <strong>Please select one option</strong>
                                </span>
                                @enderror
                        </div><br> --}}

                        <!-- /.col -->
                        <div class="col-8 float-left">
                            <a href="/"><i class="fas fa-arrow-left">  Back to login</i></a>
                        </div>
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
        <!-- jQuery -->

    </body>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>

$(document).ready(function(){

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

$('#email').blur(function(){
 var error_email = '';
 var email = $('#email').val();
 var _token = $('input[name="_token"]').val();
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(!filter.test(email))
 {    
  $('#en_icon').removeClass('text-success');
  $('#en_icon').removeClass('text-warning');
  $('#en_icon').addClass('text-danger');
  $('#en_icon').attr('data-original-title', 'Invalid Email');
  $('#en_icon').tooltip('show');
    setTimeout(function(){
        $('[data-toggle="tooltip"]').tooltip('hide');
    }, 5000);

 }
 else
 {
  $.ajax({
   url:"{{ route('email_available.check') }}",
   method:"POST",
   data:{email:email, _token:_token},
   success:function(result)
   {
    if(result == 'unique')
    {
     $('#en_icon').removeClass('text-danger');
     $('#en_icon').removeClass('text-warning');
     $('#en_icon').addClass('text-success');
     $('#en_icon').attr('data-original-title', 'Email Available');
     $('#en_icon').tooltip('show');
        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip('hide');
        }, 5000);
    }
    else
    {
     $('#en_icon').removeClass('text-danger');
     $('#en_icon').removeClass('text-success');
     $('#en_icon').addClass('text-warning');
     $('#en_icon').attr('data-original-title', 'Email Already taken');
     $('#en_icon').tooltip('show');
        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip('hide');
        }, 5000);

    }
   }
  })
 }
});

$("#username").blur(function(){

    var username = $('#username').val();
    var _token = $('input[name="_token"]').val();

    if(username.length >= 5){

        $.ajax({
            url:"{{ route('username_available.check') }}",
            method:"POST",
            data:{username:username, _token:_token},
            success:function(result)
            {
                if(result == 'unique')
                {
                $('#uc_icon').removeClass('text-danger');
                $('#uc_icon').removeClass('text-warning');
                $('#uc_icon').addClass('text-success');
                $('#uc_icon').attr('data-original-title', 'Username available');
                $('#uc_icon').tooltip('show');
                setTimeout(function(){
                    $('[data-toggle="tooltip"]').tooltip('hide');
                }, 5000);
                
                }
                else
                {
                $('#uc_icon').removeClass('text-danger');
                $('#uc_icon').removeClass('text-success');
                $('#uc_icon').addClass('text-warning');
                $('#uc_icon').attr('data-original-title', 'Username Already taken');
                $('#uc_icon').tooltip('show');
                setTimeout(function(){
                    $('[data-toggle="tooltip"]').tooltip('hide');
                }, 5000);

                }
            }
        });
    }else{

        $('#uc_icon').removeClass('text-success');
        $('#uc_icon').removeClass('text-warning');
        $('#uc_icon').addClass('text-danger');
        $('#uc_icon').attr('data-original-title', 'Username must have at leat 5 characters');
        $('#uc_icon').removeProp('data-original-title');
        $('#uc_icon').tooltip('show');
        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip('hide');
        }, 5000);

    }
});

});
    </script>
@endsection
