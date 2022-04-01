@extends('layouts.app')
@section('content')
    <form action="{{ route('clinic.info') }}" method="GET">
        @csrf

        <body class="hold-transition register-page">
            <div class="container">
                    {{-- <div class="package-grid"> --}}
                        <div class="row>">
                            @foreach ($data as $package)

                                <label class="package-card">
                                <input name="plan" class="radio" type="radio" value="{{ Crypt::encrypt($package->id) }}" checked>
                                
                                <span class="plan-details">
                                    <span class="plan-type">{{ $package->name }}</span>
                                    <span class="plan-cost">{{ $package->price }}<span class="slash">/</span><abbr class="plan-cycle" title="month">mo</abbr></span>
                                    <span>1 team member</span>
                                    <span>100 GB/mo</span>
                                    <span>1 concurrent build</span>
                                </span>
                                </label>
                            
                                
                            @endforeach
                        </div>
                    {{-- </div> --}}
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
            </div>

            <!-- /.register-box -->
            @extends('layouts.js')
            <!-- jQuery -->

        </body>
    </form>
@endsection
