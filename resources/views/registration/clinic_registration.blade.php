@include('layouts.app')
<body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Input </b><span id="clinicName"></span></a>
      </div>
      <div class="card">
        <div class="card-body register-card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
          <form action="{{ route('clinic.register') }}" method="POST">

            @csrf

            <div class="input-group mb-3">
              <input type="text" class="form-control" name="code" placeholder="Code" value="{{ old('code') }}">
              <input type="hidden" class="form-control" name="package_id" id="package_id" value="1">
              <input type="hidden" class="form-control" name="name" id="clinic_input_name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-clinic-medical"></span>
                </div>
              </div>
            </div>
            
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-eye"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-eye"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="tel" class="form-control" placeholder="Phone Number" name="phoneNumber" value={{ old('phoneNumber') }}>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <textarea rows="5" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}"></textarea>
                <div class="input-group-append">
                  
                </div>
              </div>

              <!-- /.col -->
              <div class="col-4 float-right">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
          </form>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    @extends('layouts.js')
    <script src="{{ asset('js/components/clinic-register.js') }}"></script>

    <!-- jQuery -->
    
    </body>