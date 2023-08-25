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

            <div class="col py-5">
                <div class="container-fluid">
                    @if (Session::has('success'))
                    @include('partials._toast')
                    @endif
                    <table id="clinicTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Clinic</th>
                                <th>Phone number</th>
                                <th>Status</th>
                                <th>Package</th>
                                <th>Address</th>
                                <th>Total Patients</th>
                                <th>Created At</th>
                                <th>Expire At</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinics as $clinic)
                            <tr>
                                <td>{{ $clinic->name }}</td>
                                <td>{{ $clinic->phoneNumber }}</td>
                                <td>{{ $clinic->status }}</td>
                                <td>{{ $clinic->package->name }}</td>
                                <td>{{ $clinic->address }}</td>
                                <td>{{ $clinic->patient_count }}</td>
                                <td>{{ substr($clinic->created_at, 0, 10) }}</td>
                                <td>{{ $clinic->expireDate->expire_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 10px">
                                        <div>
                                            <a href="{{ route('superadmin.clinicEdit', $clinic->id) }}" class="btn btn-default">
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
    let table = new DataTable("#clinicTable", {
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