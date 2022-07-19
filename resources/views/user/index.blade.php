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
                                <h1>Users</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">User</li>
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
                                    <div class="card-header">
                                        <a href="{{ route('user.create') }}" class="btn btn-primary float-right"><i
                                                class="fas fa-plus"></i> Add new</a>
                                    </div>
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Phone number</th>
                                                    <th>Role type</th>
                                                    <th colspan="2" style="width:15%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $row)
                                                    <tr>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ $row->code }}</td>
                                                        <td>{{ $row->phoneNumber }}</td>
                                                        <td>
                                                            @switch($row->roleType->role_type)
                                                                @case('1')
                                                                    doctor
                                                                @break
                                                                @case('2')
                                                                    receptionist
                                                                @break
                                                                @case('3')
                                                                    pharmacist
                                                                @break
                                                                @case('4')
                                                                    staff
                                                                @break
                                                                @case(5)
                                                                    admin
                                                                @break
                                                            
                                                                @default
                                                            @endswitch
                                                        </td>
                                                            
                                                        <td><a href="{{route('user.edit', $row->id)}}">
                                                            <i class="fas fa-edit fa-lg"></i></a>
                                                        </td>
                                                          
                                                        <td>
                                                            <form action="{{ route('user.destroy', $row->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

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
