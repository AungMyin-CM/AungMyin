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

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header" style=" background-color: #0077B6">
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
                                                            placeholder="Name" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input type="text" class="form-control" id="code" name="code"
                                                            placeholder="Enter code" value="{{ $user->code }}">
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="sel1">Role</label>
                                                        <select class="form-control" id="role_type" name="role_type">

                                                            @foreach ($data as $key => $value)
                                                            <option value="{{ $key }}" {{ $role->role_type == $key ? 'selected' : '' }}>{{ $value }}
                                                            </option>
                                                            
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <label for="gender">Gender</label>

                                            <div class="row">
                                                <div class="col-md-3">
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
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="gender" type="radio" value="1"
                                                            name="gender" <?php echo $m_checked;?>>
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="gender" type="radio" value="0"
                                                            name="gender" <?php echo $f_checked;?>>
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>


                                            </div><br/>

                                            <div class="row" id="doctor_section" {{$role->role_type == 1 || 5? '' : 'hidden'}}>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="speciality">Speciality</label>
                                                        <textarea class="form-control" name="speciality" row="10">{{ $user->speciality }}</textarea>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="credentials">Credentials</label>
                                                        <textarea class="form-control" name="credentials" row="10">{{ $user->credentials }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                                            name="email" placeholder="example@gmail.com" value="{{ $user->email }}">
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
                                                    name="phoneNumber" value="{{ $user->phoneNumber }}">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">Country</label>
                                                        <input type="text" class="form-control" id="country"
                                                            name="country" placeholder="Country" value="{{ $user->country }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" id="city" name="city"
                                                            placeholder="City" value="{{ $user->city }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" placeholder="Address" name="address">{{ $user->address }}</textarea>
                                            </div>


                                        
                                            <div class="form-group" id="short_bio" {{$role->role_type == 1 || 5? '' : 'hidden'}}>
                                                <label for="short_bio">Short Bio</label>
                                                <textarea class="form-control" placeholder="Doctor's Short Bio" name="short_bio">{{ $user->short_bio }}</textarea>
                                            </div>

                                            <div class="col-md-6" id="fees" {{$role->role_type == 1 || 5? '' : 'hidden'}}>
                                                <div class="form-group">
                                                    <label class="fees">Fees</label>
                                                    <input type="number" pattern="{0-9}" class="form-control" name="fees" placeholder="Fees" value="{{ $user->fees }}" />
                                                </div>
                                            </div>


                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header" style=" background-color: #0077B6">
                                            <h3 class="card-title">Permissions</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="p_view" id="p_permissions" type="checkbox" name="permission[]" value="p_view"
                                                    {{Helper::checkPermission('p_view', $role->permissions) ? 'checked' : ''}}>

                                                    <label for="p_view">Patients</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_create" name="permission[]"
                                                                value="p_create" {{Helper::checkPermission('p_create', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="p_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="p_update" name="permission[]"
                                                                value="p_update" {{Helper::checkPermission('p_update', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="p_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_delete" type="checkbox" name="permission[]"
                                                                value="p_delete" {{Helper::checkPermission('p_delete', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="p_delete" >Delete</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="p_treatment" type="checkbox" name="permission[]"
                                                                value="p_treatment" {{Helper::checkPermission('p_treatment', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="p_treatment">Treatment</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr />


                                            <div class="form-group">
                                                <div class="">
                                                    <input id="d_view" id="d_permissions" type="checkbox" name="permission[]"  value="d_view" {{Helper::checkPermission('d_view', $role->permissions) ? 'checked' : ''}}>
                                                    <label for="d_view">Dictionary</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_create" name="permission[]"
                                                                value="d_create"{{Helper::checkPermission('d_create', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="d_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="d_update" name="permission[]"
                                                                value="d_update" {{Helper::checkPermission('d_update', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="d_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="d_delete" type="checkbox" name="permission[]"
                                                                value="d_delete" {{Helper::checkPermission('d_delete', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="d_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="ph_view" id="ph_permissions" type="checkbox" name="permission[]"  value="ph_view" {{Helper::checkPermission('ph_view', $role->permissions) ? 'checked' : ''}}>
                                                    <label for="ph_view">Pharmacy</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_create" name="permission[]"
                                                                value="ph_create" {{Helper::checkPermission('ph_create', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="ph_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="ph_update" name="permission[]"
                                                                value="ph_update" {{Helper::checkPermission('ph_update', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="ph_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="ph_delete" type="checkbox" name="permission[]"
                                                                value="ph_delete" {{Helper::checkPermission('ph_delete', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="ph_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="pos_view" id="pos_permissions" type="checkbox" name="permission[]"  value="pos_view" {{Helper::checkPermission('pos_view', $role->permissions) ? 'checked' : ''}}>
                                                    <label for="pos_view">POS</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">

                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="pos_create" name="permission[]"
                                                                value="pos_create" {{Helper::checkPermission('pos_create', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="pos_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="pos_update" name="permission[]"
                                                                value="pos_update" {{Helper::checkPermission('pos_update', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="pos_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="pos_delete" type="checkbox" name="permission[]"
                                                                value="pos_delete" {{Helper::checkPermission('pos_delete', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="pos_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <div class="">
                                                    <input id="user_view" id="pos_permissions" type="checkbox" name="permission[]"  value="user_view" 
                                                    {{Helper::checkPermission('user_view', $role->permissions) ? 'checked' : ''}}>
                                                    <label for="user_view">User</label>
                                                </div>
                                                <div class="form-check" style="padding:6px !important;">

                                                    <div class="row">
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="user_create" name="permission[]"
                                                                value="user_create" {{Helper::checkPermission('user_view', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="user_create">Create</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="user_update" name="permission[]"
                                                                value="user_update" {{Helper::checkPermission('user_view', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="user_update">Update</label>
                                                        </div>
                                                        <div class="col md-4 icheck-primary d-inline mt-2">
                                                            <input id="user_delete" type="checkbox" name="permission[]"
                                                                value="user_delete" {{Helper::checkPermission('user_view', $role->permissions) ? 'checked' : ''}}>
                                                            <label for="user_delete">Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <button type="submit" class="btn btn-primary float-right" style=" background-color: #0077B6">Submit</button>
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
