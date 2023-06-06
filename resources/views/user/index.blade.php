@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                    @if (Session::has('success'))
                        @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
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

                                                <td><a href="{{route('user.edit', $row->id)}}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i></a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('user.destroy', $row->id) }}" method="post">
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