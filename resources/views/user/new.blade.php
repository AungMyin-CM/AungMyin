@extends("layouts.app")

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
             <section class="content-header">
                   {{--     <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h1>Register Form</h1>
                                
                            </div>
                            <div class="text-danger col-sm-3">
                                <ul>
                                    <i class="fa fa-info-circle d-none" id="alert"> <small>Please fill out all requried fields.</small></i>
                                </ul>
                            </div>
                            
                            <div class="col-sm-6 text-right">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active">New</li>
                                </ol>
                            </div>
                        </div>
                        
                    </div><!-- /.container-fluid --> --}}
                </section>

                <form id="form-user" >
                    @csrf
                    <section class="content" >
                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary" >
                                        <div class="card-header"  style="background-color:{{config('app.color')}}">
                                            <h3 class="card-title">Please fill out form</h3>
                                        </div>
                                           
                                        <!-- /.card-header -->
                                        <!-- form start -->


                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label for="code">Name<b><sup class="text-danger">*</sup></b></label>
                                                        <input type="text" class="form-control" id="username" name="name"
                                                            placeholder="Name" value="{{ old('name') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="code">Username<b><sup class="text-danger">*</sup></b></label>
                                                        <input type="text" class="form-control" id="code" name="code" required
                                                            placeholder="Code" value="{{ old('code') }}">
                                                        <span class="small" id="a-text"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="sel1">Role<b><sup class="text-danger">*</sup></b></label>
                                                        <select class="form-control" id="role_type" name="role_type">

                                                            @foreach ($data as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                
                                            </div>

                                            <label for="gender">Gender<b><sup class="text-danger">*</sup></b></label>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="gender" type="radio" value="1"
                                                            name="gender">
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="gender" type="radio" value="0"
                                                            name="gender">
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>


                                            </div><br/>

                                            <div class="row" id="doctor_section">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="speciality">Speciality</label>
                                                        <textarea class="form-control" name="speciality" row="10">{{ old('speciality') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="credentials">Credentials</label>
                                                        <textarea class="form-control" name="credentials" row="10">{{ old('credentials') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email address <b><sup class="text-danger">*</sup></b></label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                                                        <span class="small" id="em-text"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="password">Password <b><sup class="text-danger">*</sup></b></label>
                                                        <input type="password" class="form-control" id="password" name="password"
                                                            placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phNumber">Phone Number <b><sup class="text-danger">*</sup></b></label>
                                                <input type="tel" class="form-control" placeholder="09xxxxxxxxx"
                                                    name="phoneNumber" value={{ old('phoneNumber') }}>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">Country</label>
                                                        <input type="text" class="form-control" id="country"
                                                            name="country" placeholder="Country" value="{{ old('country') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" id="city" name="city"
                                                            placeholder="City">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address <b><sup class="text-danger">*</sup></b></label>
                                                <textarea class="form-control" placeholder="Address" name="address">{{ old('address') }}</textarea>
                                            </div>

                                            <div class="form-group" id="short_bio">
                                                <label for="short_bio">Short Bio</label>
                                                <textarea class="form-control" placeholder="Doctor's Short Bio" name="short_bio">{{ old('short_bio') }}</textarea>
                                            </div>

                                            <div class="col-md-6" id="fees">
                                                <div class="form-group">
                                                    <label class="fees">Fees <b><sup class="text-danger">*</sup></b></label>
                                                    <input type="number" pattern="{0-9}" class="form-control" name="fees" placeholder="Fees" />
                                                </div>
                                            </div>
                                            
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header "  style="  background-color:{{config('app.color')}}">
                                            <h3 class="card-title">Permissions<sup class="text-warning"> (Please check at least one property) </sup></h3>
                                            <input type="hidden" id="permission_check">
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="p_view"  type="checkbox" name="permission[]" value="p_view"
                                                    >

                                                    <label for="p_view">Patients</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_create" name="permission[]"
                                                                value="p_create">
                                                            <label for="p_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_update" name="permission[]"
                                                                value="p_update">
                                                            <label for="p_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_delete" type="checkbox" name="permission[]"
                                                                value="p_delete">
                                                            <label for="p_delete">Delete</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_treatment" type="checkbox" name="permission[]"
                                                                value="p_treatment">
                                                            <label for="p_treatment">Treatment</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr />


                                            <div class="form-group">
                                                <div class="">
                                                    <input id="d_view" id="d_permissions" type="checkbox" name="permission[]"  value="d_view">
                                                    <label for="d_view">Dictionary</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_create" name="permission[]"
                                                                value="d_create">
                                                            <label for="d_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_update" name="permission[]"
                                                                value="d_update">
                                                            <label for="d_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="d_delete" type="checkbox" name="permission[]"
                                                                value="d_delete">
                                                            <label for="d_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="ph_view" id="ph_permissions" type="checkbox" name="permission[]"  value="ph_view">
                                                    <label for="ph_view">Pharmacy</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_create" name="permission[]"
                                                                value="ph_create">
                                                            <label for="ph_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_update" name="permission[]"
                                                                value="ph_update">
                                                            <label for="ph_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="ph_delete" type="checkbox" name="permission[]"
                                                                value="ph_delete">
                                                            <label for="ph_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <hr/>
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="pos_view" id="pos_permissions" type="checkbox" name="permission[]"  value="pos_view">
                                                    <label for="pos_view">POS</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="pos_create" name="permission[]"
                                                                value="pos_create">
                                                            <label for="pos_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="pos_update" name="permission[]"
                                                                value="pos_update">
                                                            <label for="pos_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="pos_delete" type="checkbox" name="permission[]"
                                                                value="pos_delete">
                                                            <label for="pos_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="">
                                                    <input id="user_view" id="pos_permissions" type="checkbox" name="permission[]"  value="user_view">
                                                    <label for="user_view">User</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="user_create" name="permission[]"
                                                                value="user_create">
                                                            <label for="user_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="user_update" name="permission[]"
                                                                value="user_update">
                                                            <label for="user_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="user_delete" type="checkbox" name="permission[]"
                                                                value="user_delete">
                                                            <label for="user_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="button" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}" onclick="submitForm()" value="Submit">
                                        </div>

                                        <!-- Bootstrap Switch -->
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                    </section>
                </form>


            </div>
        </div>
    </body>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>

    function submitForm() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if ($('#form-user :checkbox:checked').length > 0){
            $.ajax({
                url: '{{route('clinic-user.register')}}',
                type: 'POST',
                data: $("#form-user").serialize(),
                beforeSend: function(){
                    $('.wrapper').css('opacity','0.1');
                    $('.middle').css('opacity','1');
                },
                success: function(response){
                    if(response == 1){
                        window.location = '/clinic-system/users'
                    }
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                    alert("hello");
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('.wrapper').css('opacity','0.1');
                    $('.middle').css('opacity','1');
                },
               
            })
        }
        else{
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $("#alert").removeClass('d-none');
            $("#alert").show().delay(5000).fadeOut();

        }
    }

    $("#code").blur(function(){

    var username = $('#code').val();
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
                $('#a-text').removeClass('text-danger');
                $('#a-text').removeClass('text-warning');
                $('#a-text').addClass('text-success');
                $('#a-text').text('Username available');
                $('#a-text').show();
                setTimeout(function(){
                    $('#a-text').hide();
                }, 5000);
                }else
                {
                $('#a-text').removeClass('text-danger');
                $('#a-text').removeClass('text-success');
                $('#a-text').addClass('text-warning');
                $('#a-text').text('Username Already taken');
                $('#a-text').show();
                setTimeout(function(){
                    $('#a-text').hide();
                }, 5000);
                }
            }
                
                
        });
        }else{

            $('#a-text').removeClass('text-warning');
            $('#a-text').removeClass('text-success');
            $('#a-text').addClass('text-danger');
            $('#a-text').text('Must have at leat 5 characters');
            $('#a-text').show();
            setTimeout(function(){
                $('#a-text').hide();
            }, 5000);

        }
    });

    $('#email').blur(function(){

    var error_email = '';
    var email = $('#email').val();
    var _token = $('input[name="_token"]').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!filter.test(email))
    {    
        $('#em-text').removeClass('text-danger');
        $('#em-text').removeClass('text-success');
        $('#em-text').addClass('text-warning');
        $('#em-text').text('Invaid Email');
        $('#a-text').show();
        setTimeout(function(){
            $('#em-text').hide();
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
        $('#em-text').removeClass('text-danger');
        $('#em-text').removeClass('text-warning');
        $('#em-text').addClass('text-success');
        $('#em-text').text('Valid Email');
        $('#a-text').show();
        setTimeout(function(){
            $('#em-text').hide();
        }, 5000);
        }
        else
        {
        $('#em-text').removeClass('text-danger');
        $('#em-text').removeClass('text-success');
        $('#em-text').addClass('text-warning');
        $('#em-text').text('Email Already taken');
        $('#a-text').show();
        setTimeout(function(){
        $('#em-text').hide();
        }, 5000);
        }
       
    }
    })
    }
    });
    </script>


@endsection
{{-- @include('layouts.js') --}}
