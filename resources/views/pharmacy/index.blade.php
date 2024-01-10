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
                    <div class="row">
                        @if(Helper::checkPermission('ph_create', $permissions))
                        <div class="col-6">
                            <span data-href="/clinic-system/exportMedCSV" id="export" class="btn btn-success btn-sm float-left mr-2" onclick="exportTasks(event.target);"><i class="fas fa-download"></i></span>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form method="post" action="{{ route('pharmacy.excel.import') }}" enctype="multipart/form-data" class="float-left d-flex" style="gap: 1px;">
                                @csrf

                                <!-- Import Excel File -->
                                <div class="import-container">
                                    <input type="file" id="excel-file-input" name="pharmacy_excel" accept=".xls, .xlsx" style="display:none" required />
                                    <button class="btn btn-sm text-white import-button excel" style="background-color: {{config('app.color')}}">
                                        <i class="fas fa-file-excel"></i> <span class="d-none d-md-inline">Excel</span>
                                    </button>
                                    <span class="file-name excel-file-name"></span>
                                </div>

                                <!-- Import File -->
                                <button type="submit" class="btn btn-sm text-white" id="import-submit" style="background-color: {{config('app.color')}}; display: none;">
                                    <i class="fas fa-file-import"></i> <span class="d-none d-md-inline">Import</span>
                                </button>
                            </form>
                        </div>
                        @endif
                        @if (Auth::guard('user')->user()->isAdmin())

                        <div class="col-6">
                            @if(count($data) !== 0)
                            <a href="{{ route('pharmacy.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div><!-- /.container-fluid -->

                @if (Session::has('success'))
                @include('partials._toast')
                @endif
            </section>

            <section class="content mb-3">
                <div class="container-fluid">

                    <table id="pharmacyTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Expire Date</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                @if (Auth::guard('user')->user()->isAdmin())
                                <th style="width: 10%;"><span class="d-none d-md-block">Actions</span></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->expire_date }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{ $row->status == '1' ? 'active' : 'inactive' }}</td>
                                @if (Auth::guard('user')->user()->role->role_type == 5)
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
                                @endif
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
<!-- Datatable -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>
    new DataTable("#pharmacyTable", {
        responsive: true,
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

    // Excel
    $(document).ready(function() {
        $('.import-button.excel').click(function() {
            $('#excel-file-input').click();
        });

        $('#excel-file-input').change(function(event) {
            const file = event.target.files[0];
            const $importSubmitButton = $('#import-submit');

            displayFileName(file, $(this).siblings('.excel-file-name'));

            if (file) {
                $importSubmitButton.show();
            } else {
                $importSubmitButton.hide();
            }
        });

        function displayFileName(file, $element) {
            const fileName = file ? file.name : 'No file selected';
            $element.text(fileName);
        }
    });
</script>
@endsection
