@extends("layouts.app")

@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <section class="content-header">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">User</a></li>
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                    @if (Session::has('success'))
                        @include('partials._toast')
                    @endif                            
                </div><!-- /.container-fluid -->
            </section>

            <form action="{{ route('settings.save', $user->id) }}" method="POST" enctype="multipart/form-data">
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

                                    <!-- /.card-header -->
                                    <!-- form start -->


                                    <div class="card-body">
                                        <div class="row">
                                            <div class="input-group m-auto">
                                                <input type="file" class="@error('avatar') is-invalid @enderror" onchange="loadFile(event)" name="avatar" id="upload" hidden />
                                                <label class="file_upload m-auto hover" for="upload" id="image_upload">
                                                    @if($user->avatar != '')
                                                    <img src="{{asset('images/avatars/'.$user->avatar)}}" alt="Avatar" class="avatar mb-2">
                                                    @else
                                                    <img src="{{ asset('images/web-photos/no-image.jpg') }}" class="avatar mb-2" alt="User Image" id="image_logo">
                                                    @endif

                                                </label>

                                                @error('avatar')
                                                <span class="invalid-feedback" role="alert" id="alert-message">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="code">Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" placeholder="Name" value="{{ $user->name }}">
                                                    @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" placeholder="example@gmail.com" value="{{ $user->email }}">
                                                    @error('email') <span class="text-danger small">{{ $message }}</span>@enderror
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
                                                            <input class="form-check-input" id="male" type="radio" value="1" name="gender" <?php echo $m_checked; ?>>
                                                            <label class="form-check-label" for="male">
                                                                Male
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="female" type="radio" value="0" name="gender" <?php echo $f_checked; ?>>
                                                            <label class="form-check-label" for="female">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('gender') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div><br />
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phNumber">Phone Number</label>
                                                    <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="09xxxxxxxxx" name="phoneNumber" value="{{ $user->phoneNumber }}">
                                                    @error('phoneNumber') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">

                                                    @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Confirm Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                                    </div>
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Retype password">
                                                    
                                                    @error('password_confirmation') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <small>* Leave blank if you do not want to update password</small>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary" value="Update Profile" style="background-color: {{config('app.color')}}">
                                    </div>
                                </div>
                            </div>


                            @if($role->role_type == 5)

                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color:{{config('app.color')}}">
                                            <h3 class="card-title">Package Info</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Clinic Name</p>
                                                    <p>Price</p>
                                                    <p>Purchase Date</p>
                                                    <p>Expire Date</p>
                                                    <p>Days Left</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $package->clinic->name }}</p>
                                                    <p>{{ number_format($package->price) }}</p>
                                                    <p>{{ date("F jS Y", $purchase_date) }}</p>
                                                    <p>{{ date("F jS Y", $expire_date) }}</p>
                                                    <p>{{ $days_left }} days</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                </section>
            </form>

        </div>
    </div>
</body>
<script src="{{ asset('js/user.js') }}"></script>


<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>

    var loadFile = function(event) {
        for (var i = 0; i < event.target.files.length; i++) {
            var src = URL.createObjectURL(event.target.files[i]);
            $("#image_logo").remove();
            $("#image_upload").append("<img id='image_logo' onclick='showImage(" + i + ")' src=" + src + " class='avatar mb-3' alt='img' />");

        }
    };
</script>
@endsection
{{-- @include('layouts.js') --}}