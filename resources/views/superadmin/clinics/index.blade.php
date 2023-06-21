@extends('layouts.super_layout')

@section('content')
<style>
    .dataTables_length {
        margin-bottom: 10px;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('partials._super-sidebar')

            <div class="col py-5">
                <div class="container-fluid">
                    <table id="clinicTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Clinic</th>
                                <th>Phone number</th>
                                <th>Status</th>
                                <th>Package</th>
                                <th>Address</th>
                                <th>Created At</th>
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
                                <td>{{ $clinic->created_at->format('F jS Y') }}</td>
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable("#clinicTable", {
        "paging": true,
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