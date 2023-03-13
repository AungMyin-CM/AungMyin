@extends('layouts.app')
@section('content')
<style>
    .field-icon {
        float: right;
        margin-right: 8px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }

</style>
<div class="login-page bg-light">
    <div class="container">
        
            <div class="col-lg-7 offset-lg-2"> 
                <div class="bg-white shadow rounded">
                   
                        {{-- <div class="col-md-5 ps-0 d-none d-md-block py-5 px-5  " style="background-color: {{config('app.color')}}">
                            <div class="form-right  h-100  text-white text-center pt-5">
                                <img src="{{ asset('images/logo.png') }}" class="brand-image"  >
                                <h2 class="fs-1">Aung Myin</h2>
                                <p class="fs-1">Clinic Manager</p>
                            </div>
                        </div> --}}
                        <div class="pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <h3 class="mb-3 text-center"><b>Registration </b><span id="clinicName">Form</span></h3>
                                @if(Session::has('message'))
                                <div class="alert alert-danger" id="alert-message">
                                     {{Session::get('message')}}
                                </div><br />
                                @elseif(Session::has('alert'))
                                <div class="alert alert-warning" id="alert-message">
                                     {{Session::get('alert')}}
                                </div><br />
                                @elseif(Session::has('success'))
                                <div class="alert alert-info" id="alert-message">
                                     {{Session::get('success')}}
                                </div><br />
                                @endif
                                <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="input-group m-auto">
                                        <input type="file" class="@error('avatar') is-invalid @enderror" onchange="loadFile(event)" name="avatar" id="upload" hidden/>
                                        <label class="file_upload m-auto hover" for="upload" id="image_upload">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHDRlp-KGr_M94k_oor4Odjn2UzbAS7n1YoA&usqp=CAU" alt="Avatar" class="avatar mb-2" id="image_logo">
                                        </label>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert" id="alert-message">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                        <div class="row">

                                            <div class="col-6">
                                                <label for="gender">Hello</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                                                        </div>
                                                        <select name="title" id="title" class="form-control @error('gender') is-invalid @enderror">
                                                            <option value="Mr" selected>Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Miss">Miss</option>
                                                            <option value="Ms">Ms</option>
                                                        </select>
                                                        @error('gender')
                                                        <span class="invalid-feedback" role="alert" id="alert-message">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-6 mb-1">
                                                <label>Name<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name"
                                                    value="{{ old('name') }}" id="name">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert" id="alert-message">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                         
                                        <div class="col-12 mb-1">
                                            <label>Code<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-user-circle hover" id="uc_icon"></span></div>
                                                </div>
                                                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Code"
                                                value="{{ old('code') }}" id="username">
                                                @error('code')
                                                <span class="invalid-feedback" role="alert" id="alert-message">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-user-circle hover" id="en_icon"></span></div>
                                                </div>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"
                                                value="{{ old('email') }}" id="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert" id="alert-message">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                                </div>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"  id="password" toggle="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert" id="alert-message">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}


                                        </div>
                                        <div class="col-12 mb-1">
                                            <label>Confirm Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                                </div>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                                placeholder="Retype password">
                                            </div>
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert" id="alert-message">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label>Phone Number<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                                </div>
                                                <div class="input-group-prepend">
                                                    <select name="" id="" class="form-input">
                                                        <option value="mm">+95 (MM)</option>
                                                    </select>
                                                </div>
                                                <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="09xxxxxxxx" name="phoneNumber"
                                                    value={{ old('phoneNumber') }}>
                                                    @error('phoneNumber')
                                                        <span class="invalid-feedback" role="alert" id="alert-message">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
           
                                        <div class="col-12  mt-4">
                                            <a href="/"><i class="fas fa-arrow-left" style="color:  {{config('app.color')}}">  Back to login</i></a>
                                            <button type="submit" class="btn btn-primary  float-right" style="background-color: {{config('app.color')}}">Register</button>
                                        </div>
                                      
                                </form>
                            </div>
                        </div>
            
                    
                </div>
                
            </div>
       
    </div>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>


<script>

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function(){

$('form').on('submit',function(){
    $('.rounded').css('opacity','0.1');
    $('.middle').css('opacity','1');
});

$("input").keypress(function(){
    $("#alert-message").hide();
    $("input").removeClass('is-invalid')
});

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $('#password').attr("toggle")
        if (input == "password") {
            $("#password").attr('type',"text"); 
            $('#password').attr("toggle",'text');
        } else {
            $("#password").attr("type", "password");
            $('#password').attr("toggle",'password');

        }
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
$('#en_icon').attr('title', 'Invalid Email');
   

}
else
{
$.ajax({
url:"{{ route('email_available.check') }}",
method:"POST",
data:{email:email, _token:_token},
success:function(result)
{
    $("#en_icon").tooltip({
        track: true,
    });

    if(result == 'unique')
    {
    $('#en_icon').removeClass('text-danger');
    $('#en_icon').removeClass('text-warning');
    $('#en_icon').addClass('text-success');
    $('#en_icon').attr('title', 'Email Available');
    $( "#en_icon" ).tooltip({
        show: { effect: "blind", duration: 800 }
    }); 

    }
    else
    {
    $('#en_icon').removeClass('text-danger');
    $('#en_icon').removeClass('text-success');
    $('#en_icon').addClass('text-warning');
    $('#en_icon').attr('title', 'Email Already taken');
    $( "#en_icon" ).tooltip({
        show: { effect: "blind", duration: 800 }
    });  
        

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
                $("#uc_icon").tooltip({
                    track: true,
                });
                if(result == 'unique')
                {
                $('#uc_icon').removeClass('text-danger');
                $('#uc_icon').removeClass('text-warning');
                $('#uc_icon').addClass('text-success');
                $('#uc_icon').attr('title', 'Username available');
                $( "#uc_icon" ).tooltip({
                    show: { effect: "blind", duration: 800 }
                });               
                }
                else
                {
                $('#uc_icon').removeClass('text-danger');
                $('#uc_icon').removeClass('text-success');
                $('#uc_icon').addClass('text-warning');
                $('#uc_icon').attr('title', 'Username Already taken');
                $( "#uc_icon" ).tooltip({
                    show: { effect: "blind", duration: 800 }
                });                
                }
            }
        });
    }else{

        $('#uc_icon').removeClass('text-success');
        $('#uc_icon').removeClass('text-warning');
        $('#uc_icon').addClass('text-danger');
        $('#uc_icon').attr('title', 'Username must have at leat 5 characters');
        $( "#uc_icon" ).tooltip({
            show: { effect: "blind", duration: 800 }
        });      
    }
});

});

var loadFile = function(event) {
    for(var i =0; i< event.target.files.length; i++){
        var src = URL.createObjectURL(event.target.files[i]);
        $("#image_logo").remove();
        $("#image_upload").append("<img id='image_logo' onclick='showImage("+i+")' src="+src+" class='avatar mb-3' alt='img' />");

    }
};
</script>
@endsection

 