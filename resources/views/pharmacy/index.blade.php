@extends("layouts.app")
@section('content')
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;

        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .inputfile+label {
        font-size: 0.875rem;
        font-weight: 700;
        color: white;
        background-color: #003049;
        display: inline-block;
        padding: 5px;
        border-radius: 5px;
        margin-left: 15px;
    }

    .inputfile:focus+label,
    .inputfile+label:hover {
        background-color: #003049;
    }

    .inputfile+label {
        cursor: pointer;
        /* "hand" cursor */
    }

    .pagination .active .page-link {
        background-color: #003049;
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
                    <div class="row">
                        <div class="col-sm-4"></div>
                        @if(Helper::checkPermission('ph_create', $permissions))
                        <div class="col-sm-4">
                            <span data-href="/clinic-system/exportMedCSV" id="export" class="btn btn-success btn-sm float-left" onclick="exportTasks(event.target);">Export</span>

                            <form method="post" action="{{ route('pharmacy.import') }}" enctype="multipart/form-data" class="float-left">
                                @csrf
                                <input type="file" name="importFile" id="importFile" accept=".csv" class="inputfile" required />
                                <label for="importFile">Choose a file....</label>
                                <input type="submit" value="Import" name="import" class="btn btn-success btn-sm" style="background: {{config('app.color')}}; color:white; border-radius: 5px; cursor: pointer;" />
                            </form>
                        </div>
                        @endif
                        <div class="col-sm-4">
                            @if(count($data) !== 0)
                            <a href="{{ route('pharmacy.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
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

                    <table id="pharmacyTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Expire Date</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->expire_date }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{ $row->status == '1' ? 'active' : 'inactive' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 20px">
                                        <div>
                                            @if(Helper::checkPermission('ph_update', $permissions))
                                            <a href="{{ route('pharmacy.edit' ,  Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i>
                                            </a>
                                            @endif
                                        </div>

                                        <div>
                                            @if(Helper::checkPermission('ph_delete', $permissions))
                                            <form action="{{ route('pharmacy.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-default" type="Submit">
                                                    <i class="fas fa-trash" style="color:#E95A4A; "></i>
                                                </button>
                                            </form>
                                            @endif
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
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    let table = new DataTable("#pharmacyTable", {
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search medicine...",
            search: "",
            emptyTable: "No data available in table.<br><br><button id='addDataBtn' class='btn text-white addDataBtn'><i class='fas fa-plus'></i> Add new</button>"
        },
    });

    $(document).ready(function() {
        $('#addDataBtn').on('click', function() {
            window.location.href = "{{ route('pharmacy.create') }}";
        });
    });

    $('#fileUpload').change(function(e) {

        console.log(e.target.files[0])

    });

    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>
@endsection