@extends('layouts.app')
@section('content')

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="row">
                <div class="col-sm-4">
                    <!-- radio -->
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" id="packageId" type="radio" value="1" name="package_id" checked>
                            <label class="form-check-label">Trial</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- radio -->
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" id="packageId" type="radio" value="2" name="package_id">
                            <label class="form-check-label">Basic</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- radio -->
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" id="packageId" type="radio" value="3" name="package_id">
                            <label class="form-check-label">Premium</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-logo">
                <a href="../../index2.html"><b>Input </b>Your Clinic Name</a>
            </div>


            <div class="card">
                <div class="card-body register-card-body">
                    <div class="input-group mb-3">
                        <input type="text" id="clinic_name" class="form-control" name="clinic_name" placeholder="Name">
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
        <script src="{{ asset('js/components/clinic-name.js') }}"></script>
        <!-- jQuery -->

    </body>
@endsection
