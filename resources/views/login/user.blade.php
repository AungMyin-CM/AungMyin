@extends('layouts.app')

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Aung</b>Myin</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          @if ($errors->any())
            <div class="alert alert-danger" id="alert-message">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif

          @if (Session::has('message'))
            <div class="alert alert-danger" id="alert-message">
              <ul class="list-unstyled">
                    <li>
                      {{ Session::get('message')}}
                     </li> 
              </ul>
            </div>
          @endif

          <form action="{{route('user.login')}}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Code" name="code" value="{{old('code')}}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-0">
            <a href="{{ route('clinic.login') }}" class="text-center">Login as clinic</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
</body>
    <!-- /.login-box -->
    
    <!-- jQuery -->
@endsection