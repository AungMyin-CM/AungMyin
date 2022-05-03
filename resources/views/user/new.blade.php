@extends("layouts.app")

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Register Form</h1>
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

                <form action="{{ route('user.register') }}" method="POST">
                    @csrf

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


                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label for="code">Name</label>
                                                        <input type="text" class="form-control" id="username" name="name"
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input type="text" class="form-control" id="code" name="code"
                                                            placeholder="Enter code" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="sel1">Role</label>
                                                        <select class="form-control" id="sel1" name="role_type">

                                                            @foreach ($data as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                                            name="email" placeholder="example@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password"
                                                            placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phNumber">Phone Number</label>
                                                <input type="tel" class="form-control" placeholder="09xxxxxxxxx"
                                                    name="phoneNumber" value={{ old('phoneNumber') }}>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">Country</label>
                                                        <input type="text" class="form-control" id="country"
                                                            name="country" placeholder="Country">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" id="city" name="city"
                                                            placeholder="City">
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
                                                        <input class="form-check-input" id="gender" type="radio" value="1"
                                                            name="gender">
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="gender" type="radio" value="0"
                                                            name="gender">
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Permissions</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="p_view" id="p_permissions" type="checkbox" name="permission[]" value="p_view"
                                                    >

                                                    <label for="p_view">Patients</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_create" name="permission[]"
                                                                value="p_create">
                                                            <label for="p_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_update" name="permission[]"
                                                                value="p_update">
                                                            <label for="p_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_delete" type="checkbox" name="permission[]"
                                                                value="p_delete">
                                                            <label for="p_delete">Delete</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_treatment" type="checkbox" name="permission[]"
                                                                value="p_treatment">
                                                            <label for="p_treatment">Treatment</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr />


                                            <div class="form-group">
                                                <div class="">
                                                    <input id="d_view" id="d_permissions" type="checkbox" name="permission[]"  value="d_view">
                                                    <label for="d_view">Dictionary</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_create" name="permission[]"
                                                                value="d_create">
                                                            <label for="d_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_update" name="permission[]"
                                                                value="d_update">
                                                            <label for="d_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="d_delete" type="checkbox" name="permission[]"
                                                                value="d_delete">
                                                            <label for="d_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="ph_view" id="ph_permissions" type="checkbox" name="permission[]"  value="ph_view">
                                                    <label for="ph_view">Pharmacy</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_create" name="permission[]"
                                                                value="ph_create">
                                                            <label for="ph_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_update" name="permission[]"
                                                                value="ph_update">
                                                            <label for="ph_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="ph_delete" type="checkbox" name="permission[]"
                                                                value="ph_delete">
                                                            <label for="ph_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </div>
                                        <!-- Bootstrap Switch -->
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                    </section>
                </form>

            </div>
        </div>
    </body>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
{{-- @include('layouts.js') --}}
