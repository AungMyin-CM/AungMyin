@extends("layouts.app")
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Patients</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Patient</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                @if (Session::has('success'))
                    <div class="col-md-6">
                        <div class="alert alert-success" id="alert-message">
                            <ul class="list-unstyled">
                                <li>
                                    {{ Session::get('success') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                     @if(Helper::checkPermission('ph_create', $permissions))
                                        <div class="card-header">
                                            <a href="{{ route('pharmacy.create') }}" class="btn btn-primary float-right"><i
                                            class="fas fa-plus"></i> Add new</a>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered table-striped">                                    
                                          <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Expire Date</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Actions</th>
                                                {{-- <th></th>
                                                <th></th> --}}
                                                {{-- <th colspan="3" style="width:15%;">Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->code }}</td>
                                                    <td>{{ $row->age }}</td>
                                                    <td>{{ $row->gender == 1 ? 'male' : 'female' }}</td>
                                                    <td>
                                                        <div class="row">
                                                            @if(Helper::checkPermission('p_update', $permissions))

                                                                <a href="{{ route('patient.edit' ,  Crypt::encrypt($row->id)) }}" style="margin:10px ;">
                                                                <i class="fas fa-edit fa-lg"></i></a>

                                                            @endif

                                                            @if(Helper::checkPermission('p_treatment', $permissions) && $role_type == 1 )
                                                                <a href="{{ route('patient.treatment', Crypt::encrypt($row->id)) }}" style="margin:10px ;"
                                                                ><i class="fas fa-stethoscope fa-lg"></i></a>
                                                            @endif

                                                            @if(Helper::checkPermission('p_delete', $permissions))

                                                                <form action="{{ route('patient.destroy', $row->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')   
                                                                    <button class="" type="submit" style="margin:5px;"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                                </form>

                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                      </div>
                                    
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
@endsection

       
