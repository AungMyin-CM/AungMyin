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
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        @if(Helper::checkPermission('p_create', $permissions))
                        <div class="col-sm-4">
                            <span data-href="/clinic-system/exportPatientCSV" id="export" class="btn btn-success btn-sm float-left mr-2" onclick="exportTasks(event.target);"><i class="fas fa-download"></i></span>

                            <form method="post" action="{{ route('patient.import') }}" enctype="multipart/form-data" class="float-left d-flex" style="gap: 1px;">
                                @csrf

                                <!-- Import Excel File -->
                                <div class="import-container">
                                    <input type="file" id="excel-file-input" accept=".xls, .xlsx" style="display:none" required />
                                    <button class="btn btn-sm text-white import-button excel" style="background-color: {{config('app.color')}}">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </button>
                                    <span class="file-name excel-file-name"></span>
                                </div>

                                <!-- Import CSV File -->
                                <div class="import-container">
                                    <input type="file" name="importFile" id="csv-file-input" accept=".csv" style="display:none" required />
                                    <button class="btn btn-sm text-white import-button csv" style="background-color: {{config('app.color')}}">
                                        <i class="fas fa-file-csv"></i> CSV
                                    </button>
                                    <span class="file-name csv-file-name"></span>
                                </div>

                                <!-- Import File -->
                                <button type="submit" class="btn btn-sm text-white" style="background-color: {{config('app.color')}}">
                                    <i class="fas fa-file-import"></i> Import
                                </button>

                                <!-- <input type="file" name="importFile" id="importFile" accept=".csv" class="inputfile" required />
                                <label for="importFile">Choose a file....</label>
                                <input type="submit" value="Import" name="import" class="btn text-white btn-sm" style="background: {{config('app.color')}};
                                color:white;
                                border-radius: 5px;
                                cursor: pointer;" /> -->
                            </form>
                        </div>
                        @endif
                        <div class="col-sm-4">
                            <a href="{{ route('patient.create') }}" class="btn float-right" style="color:{{config('app.secondary_color')}}; background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                @if (Session::has('success'))
                @include('partials._toast')
                @endif
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div id="patient-lists">
                        @include('partials._patient-card')
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }

    // Ajax Pagination
    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    });

    function fetch_data(page) {
        $.ajax({
            url: "?page=" + page,
            success: function(data) {
                $('#patient-lists').html(data);
            }
        });
    }

    // Excel - CSV
    $(document).ready(function() {
        $('.import-button.excel').click(function() {
            $('#excel-file-input').click();
        });

        $('.import-button.csv').click(function() {
            $('#csv-file-input').click();
        });

        $('#excel-file-input').change(function(event) {
            const file = event.target.files[0];
            displayFileName(file, $(this).siblings('.excel-file-name'));
        });

        $('#csv-file-input').change(function(event) {
            const file = event.target.files[0];
            displayFileName(file, $(this).siblings('.csv-file-name'));
        });

        function displayFileName(file, $element) {
            const fileName = file ? file.name : 'No file selected';
            $element.text(fileName);
        }
    });
</script>
@endsection