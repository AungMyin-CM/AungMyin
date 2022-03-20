@extends('layouts.app')
@section('content')
    <form action="{{ route('clinic.info') }}" method="POST">
        @csrf

        <body class="hold-transition register-page">
            <div class="row">

                @foreach ($data as $package)
                    <div class="col-md-6">

                        <div class="card card-widget widget-user">
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{ $package->name }}</h3>
                                <h5 class="widget-user-desc">{{ $package->price }}</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2"
                                    src="https://cdn.britannica.com/70/191970-050-1EC34EBE/Color-wheel-light-color-spectrum.jpg?q=60"
                                    alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $package->price }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Description</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" id="packageId" type="radio"
                                            value="{{ $package->id }}" name="package_id" required>
                                        <label class="form-check-label">{{ $package->name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="register-logo">
                <a href="../../index2.html"><b>Input </b>Your Clinic Name</a>
            </div>

            <div class="register-box">

                <div class="card">
                    <div class="card-body register-card-body">
                        <div class="input-group mb-3">
                            <input type="text" id="clinic_name" class="form-control" name="clinic_name" placeholder="Name"
                                title="Name should contain atleast 5 characters" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-clinic-medical"></span>
                                </div>
                            </div>
                        </div>
                        <span id="error_clinic_name" style="color:red"></span>
                        <!-- /.col -->
                        <div class="col-4 float-right">
                            <input type="submit" id="register_clinic" class="btn btn-primary btn-block" value="Continue" />
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
            @extends('layouts.js')
            <!-- jQuery -->

        </body>
    </form>
@endsection
