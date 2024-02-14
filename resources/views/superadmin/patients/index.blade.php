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
                    <table id="patientTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Address</th>
                                <th>Clinic</th>
                                <th>Visit count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->address }}</td>
                                <td>{{ $patient->clinic->name }}</td>
                                <td>{{ $patient->visits->count() }}</td>
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
    let table = new DataTable("#patientTable", {
        "paging": true,
        "info": true,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search patients...",
            search: "",
        },
    });
</script>
@endsection
