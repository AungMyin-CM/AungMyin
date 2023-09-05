@extends("layouts.app")
@section('content')

<style>
    .pagination .active .page-link {
        background-color: #003049;
    }

    .pagination .active {
        z-index: 0;
    }

    .addDataBtn {
        background-color: #003049;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            @if(count($data) !== 0)
                            <a href="{{ route('user.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                            @endif
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                @if (Session::has('success'))
                @include('partials._toast')
                @endif
            </section>

            <section class="content mb-3">
                <div class="container-fluid">
                    <table id="userTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Role type</th>
                                <th style="width: 10%;"><span class="d-none d-md-block">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->first_name.' '.$row->last_name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phoneNumber ? $row->phoneNumber : '-' }}</td>
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

                </div>
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Datatable -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>
    new DataTable('#userTable', {
        responsive: true,
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search users...",
            search: "",
            emptyTable: "No data available in table.<br><br><button id='addDataBtn' class='btn text-white addDataBtn'><i class='fas fa-plus'></i> Add new</button>"
        },
    });

    $(document).ready(function() {
        $('#addDataBtn').on('click', function() {
            window.location.href = "{{ route('user.create') }}";
        });
    });
</script>

@endsection