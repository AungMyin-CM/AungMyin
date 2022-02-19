@extends('layouts.app')
<body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Input </b>Your Clinic Name</a>
      </div>
      <div class="card">
        <div class="card-body register-card-body">
    
          <form action="{{ route('register-clinic') }}" method="GET">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="clinic_name" placeholder="Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-clinic-medical"></span>
                </div>
              </div>
            </div>

              <!-- /.col -->
              <div class="col-4 float-right">
                <button type="submit" class="btn btn-primary btn-block">Continue</button>
              </div>
              <!-- /.col -->
          </form>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    @extends('layouts.js')
    <!-- jQuery -->
    
    </body>