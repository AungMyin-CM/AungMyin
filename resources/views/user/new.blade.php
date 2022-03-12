@extends("layouts.app")

@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">New</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Please fill out form</h3>
                    </div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('user.register') }}" method="POST">

                      @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Name</label>
                            <input type="text" class="form-control" id="username" name="name" placeholder="Name">
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Enter code" value="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="sel1">Select list:</label>
                              <select class="form-control" id="sel1" name="role_type">
                    
                                @foreach ( json_decode($data) as  $value)
                                  <option value="{{ $value[0] }}">{{  $value[0] }}</option>
                                @endforeach

                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="phNumber">Phone Number</label>
                          <input type="tel" class="form-control" placeholder="09xxxxxxxxx" name="phoneNumber" value={{ old('phoneNumber') }}>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="city">Country</label>
                              <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="city">City</label>
                              <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="address">Address</label>
                          <textarea class="form-control" placeholder="Address" name="address">{{ old('address') }}</textarea>
                        </div>

                        <label for="gender">Gender</label>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" id="gender" type="radio" value="1" name="gender">
                              <label class="form-check-label" for="male">
                                Male
                              </label>
                            </div>
                            
                            
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" id="gender" type="radio" value="0" name="gender">
                              <label class="form-check-label" for="female">
                                Female
                              </label>
                          </div>
                        </div>

                       
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>
  </div>
</body>
@endsection
    {{-- @include('layouts.js') --}}
