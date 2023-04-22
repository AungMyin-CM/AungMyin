@extends("layouts.app")

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
                <section class="content-header">
                    {{-- <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Register Form</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active">New</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid --> --}}
                </section>

                <form action="{{ route('settings.save', $user->id) }}" method="POST">
                    @csrf

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-8">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color:{{config('app.color')}}">
                                            <h3 class="card-title">Update Profile</h3>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger m-3">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br />
                                        @endif

                                        @if (Session::has('success'))
                                            <div class="col-md-6">
                                                <div class="alert alert-success m-3" id="alert-message">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            {{ Session::get('success') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- /.card-header -->
                                        <!-- form start -->


                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="code">Name</label>
                                                        <input type="text" class="form-control" id="username" name="name"
                                                            placeholder="Name" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                                            name="email" placeholder="example@gmail.com" value="{{ $user->email }}">
                                                    </div>
                                                </div>

                                                

                                                
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <label for="gender">Gender</label>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            @if($user->gender == 1) 
                                                            <?php 
                                                                $m_checked = 'checked';
                                                                $f_checked = '';
                                                            ?>
                                                        @else
                                                            <?php 
                                                                $m_checked = '';
                                                                $f_checked = 'checked';
                                                            ?>
                                                        @endif
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="male" type="radio" value="1"
                                                                    name="gender" <?php echo $m_checked;?>>
                                                                <label class="form-check-label" for="male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="female" type="radio" value="0"
                                                                    name="gender" <?php echo $f_checked;?>>
                                                                <label class="form-check-label" for="female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </div><br/>

                                                    
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phNumber">Phone Number</label>
                                                        <input type="tel" class="form-control" placeholder="09xxxxxxxxx"
                                                            name="phoneNumber" value="{{ $user->phoneNumber }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password"
                                                            placeholder="Password">
                                                        <small class=""></small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
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
                                                <small>* Leave blank if you do not want to update password</small>
                                            </div>
                                            

                                        </div>
                                        <div class="card-footer">
                                            <input type="submit" class="btn btn-primary" value="Update Profile" style="background-color: {{config('app.color')}}">
                                        </div>
                                    </div>

                                </div>
                               
                            </div>
                    </section>
                </form>

            </div>
        </div>
    </body>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
{{-- @include('layouts.js') --}}
