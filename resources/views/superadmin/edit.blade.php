@extends('layouts.super_layout')

@section('content')

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('superadmin.update', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="input-group m-auto">
                                    <input type="file" class="@error('avatar') is-invalid @enderror" onchange="loadFile(event)" name="avatar" id="upload" hidden />
                                    <label class="file_upload m-auto hover" style="cursor: pointer;" for="upload" id="image_upload">
                                        @if($user->avatar != '')
                                        <img src="{{asset('images/avatars/'.$user->avatar)}}" alt="Avatar" class="img-thumbnail rounded-circle mb-3" width="70px" height="70px">
                                        @else
                                        <img src="{{ asset('images/web-photos/no-image.jpg') }}" class="img-thumbnail rounded-circle mb-3" alt="User Image" id="image_logo" width="70px" height="70px">
                                        @endif
                                    </label>

                                    @error('avatar')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value=" {{ $user->name }}">
                                    </div>
                                    @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                    @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" placeholder="09xxxxxxxxx" value={{ $user->phoneNumber }}>
                                    </div>
                                    @error('phoneNumber')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="credentials">Credentials</label>
                                        <input type="text" class="form-control" name="credentials" placeholder="Credentials" value="{{ $user->credentials }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="speciality">Speciality</label>
                                        <input type="speciality" class="form-control" name="speciality" placeholder="Speciality" value="{{ $user->speciality }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fees">Fees</label>
                                        <input type="text" class="form-control" name="fees" placeholder="Fees" value="{{ $user->fees }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="address">Address</label>
                                <textarea class="form-control" placeholder="Address" name="address">{{ $user->address }}</textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                    </div>
                                    @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Retype password">
                                    </div>
                                    @error('password_confirmation')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
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
                                <div class="row">
                                    <div class="col-md-3">
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
                                </div>
                                <span id="genderError" class="text-danger small"></span>
                            </div>
                        </div>

                        <div class="card-footer text-center p-3">
                            <button type="submit" class="btn" id="updateBtn" style="color: {{config('app.secondary_color')}};background-color: {{config('app.color')}}">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    let loadFile = function(event) {
        for (let i = 0; i < event.target.files.length; i++) {
            let src = URL.createObjectURL(event.target.files[i]);
            $("#image_logo").remove();
            $("#image_upload").append("<img id='image_logo' onclick='showImage(" + i + ")' src=" + src + " class='img-thumbnail rounded-circle mb-3' width='70px' height='70px' alt='img' />");
        }
    };
</script>

@endsection