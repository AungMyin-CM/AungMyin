@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user.clinic', Crypt::encrypt(session() -> get('cc_id'))) }}">Home</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('user.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>                            
                        </div>
                    </div>
                    
                    @if (Session::has('success'))
                        @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <table id="userTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Phone number</th>
                                <th>Role type</th>
                                <th style="width: 10%;">Actions</th>
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

                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 20px">
                                        <div>
                                            <a href="{{route('user.edit', $row->id)}}" class="btn btn-default">
                                                <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('user.destroy', $row->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-default" type="submit">
                                                    <i class="fas fa-trash" style="color:#E95A4A;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>

                    <div class="float-right p-2">
                        {{ $data->links('pagination.bootstrap-4') }}
                    </div>
              
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable("#userTable", {
        "paging": false,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search users...",
            search: "",
        },
    });
</script>

@endsection