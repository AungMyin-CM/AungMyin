@extends('layouts.super_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" id="updateForm">
                @csrf
                @method('PATCH')
                <div class="card card-primary">
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value=" {{ $user->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" class="form-control" name="phoneNumber" placeholder="09xxxxxxxxx" value={{ $user->phoneNumber }}>
                                </div>
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

@endsection