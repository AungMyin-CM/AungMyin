@extends('layouts.super_layout')

@section('content')
<style>
    .pagination .active .page-link {
        background-color: #003049;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('partials._super-sidebar')

            <div class="col py-3">
                <div class="container-fluid">
                    <div class="dropdown mb-4">
                        <a class="btn text-white dropdown-toggle" style="background-color: {{config('app.color')}};" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-filter-left"></i>
                            Filters
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.users') }}">All Users</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.filter', 'p_users') }}">Package Purchased Users</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.filter', 'c_users') }}">Clinic Users</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.filter', 'v_users') }}">Only Verified</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.filter', 'u_users') }}">Unverified Users</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('superadmin.filter', 'f_users') }}">Free Users</a>
                            </li>
                        </ul>
                    </div>
                    @if (Session::has('success'))
                    @include('partials._toast')
                    @endif
                    <table id="userTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Role type</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phoneNumber }}</td>
                                <td>
                                    @if($user->role)
                                    @switch($user->role->role_type)
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
                                    @endif
                                </td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->status ? 'Active' : 'Disable' }}</td>

                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 10px">
                                        <div>
                                            <a href="{{route('superadmin.edit', $user->id)}}" class="btn btn-default">
                                                <i class="bi bi-pencil-square fs-4" style=" color: {{config('app.color')}}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    let table = new DataTable("#userTable", {
        "paging": true,
        "info": true,
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