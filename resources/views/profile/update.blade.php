@extends("layouts.app")

@section('content')

<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Add Animation */
    .modal-content {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {

        .modal-content {
            width: 100%;
        }
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <section class="content-header"></section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-8">

                            <form action="{{ route('settings.save', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color:{{config('app.color')}}">
                                        <h3 class="card-title">Update Profile</h3>
                                    </div>

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
                            </form>
                        </div>

                        <div class="col-md-4">
                            @if($role->role_type == 5)

                            <div class="card card-primary">
                                <div class="card-header" style="background-color:{{config('app.color')}}">
                                    <h3 class="card-title">Package Info</h3>
                                    <span id="clinicEdit" class="float-right" style="cursor: pointer;">
                                        Edit
                                    </span>
                                    @include('profile._clinic-edit')
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
                                            <p id="clinicName">{{ $package->clinic->name }}</p>
                                            <p>{{ number_format($package->price) }}</p>
                                            <p>{{ date("F jS Y", $purchase_date) }}</p>
                                            <p>{{ date("F jS Y", $expire_date) }}</p>
                                            <p>{{ $days_left }} days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
            </section>

        </div>
    </div>
</body>
<script src="{{ asset('js/user.js') }}"></script>


<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
    let loadFile = function(event) {
        for (let i = 0; i < event.target.files.length; i++) {
            let src = URL.createObjectURL(event.target.files[i]);
            $("#image_logo").remove();
            $("#image_upload").append("<img id='image_logo' onclick='showImage(" + i + ")' src=" + src + " class='avatar mb-3' alt='img' />");
        }
    };

    let editModal = document.getElementById("clinicEditModal");
    let editBtn = document.getElementById("clinicEdit");

    editBtn.onclick = function() {
        editModal.style.display = "block";
    }

    $("#clinicClose").click(function(e) {
        editModal.style.display = "none";
    })

    let selectedLogo = null;

    let loadClinicLogo = function(event) {
        if (event.target.files && event.target.files[0]) {
            let file = event.target.files[0];
            selectedLogo = file;
            let src = URL.createObjectURL(file);
            $('#clinicLogoImage').attr('src', src);
        }
    };

    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#updateClinic').submit(function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        if (selectedLogo !== null) {
            formData.append('avatar', selectedLogo);
        } else {
            formData.delete('avatar');
        }

        $.ajax({
            url: "{{ route('clinic.update', $package->clinic->id) }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (selectedLogo !== null) {
                    let updatedLogoUrl = "{{ asset('images/clinic-logos/') }}/" + response.avatar;
                    $('#clinicLogoImage').attr('src', updatedLogoUrl);
                }

                editModal.style.display = "none";
                $('.wrapper').css('opacity', '1');
                $('.middle').css('opacity', '0.1');

                $('#clinicName').html("<p>" + response.name + "</p>");
            },
            error: function(xhr) {
                // Handle the error response
                $('.wrapper').css('opacity', '1');
                $('.middle').css('opacity', '0.1');

                let data = JSON.parse(xhr.responseText);

                let name = data.errors.name ? data.errors.name[0] : '';
                let phoneNumber = data.errors.phoneNumber ? data.errors.phoneNumber[0] : '';
                let address = data.errors.address ? data.errors.address[0] : '';

                $('#nameError').html(name);
                $('#phoneError').html(phoneNumber);
                $('#addressError').html(address);
            }
        });
    });

    // 
</script>
@endsection
{{-- @include('layouts.js') --}}