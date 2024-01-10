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
                        @if(Helper::checkPermission('p_create', $permissions))
                        <div class="col-6">
                            {{-- <span data-href="/clinic-system/exportPatientCSV" id="export" class="btn btn-success btn-sm float-left mr-2" onclick="exportPatientTasks(event.target);"><i data-href="/clinic-system/exportPatientCSV" class="fas fa-download"></i></span> --}}
                            <a href="{{route('exportPatient')}}">
                                <span id="export" class="btn btn-success btn-sm float-left mr-2">
                                    <i class="fas fa-download"></i>
                                </span>
                            </a>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form method="post" action="{{ route('patient.excel.import') }}" enctype="multipart/form-data" class="float-left d-flex" style="gap: 1px;">
                                @csrf
                                @method('post')

                                <!-- Import Excel File -->
                                <div class="import-container">
                                    <input type="file" id="excel-file-input" name="patient_excel" accept=".xls, .xlsx" style="display:none" required />
                                    <a href="#" class="btn btn-sm text-white import-button excel" style="background-color: {{config('app.color')}}">
                                        <i class="fas fa-file-excel"></i> <span class="d-none d-md-inline">Excel</span>
                                    </a>
                                    <span class="file-name excel-file-name"></span>
                                </div>

                                <!-- Import File -->
                                <button type="submit" class="btn btn-sm text-white" id="import-submit" style="background-color: {{config('app.color')}}; display: none;">
                                    <i class="fas fa-file-import"></i> <span class="d-none d-md-inline">Import</span>
                                </button>
                            </form>
                        </div>
                        @endif
                        <div class="col-6">
                            @if(count($data) !== 0)
                            <a href="{{ route('patient.create') }}" class="btn float-right" style="color:{{config('app.secondary_color')}}; background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                            @endif
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

    // Ajax Pagination
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    });

    function exportPatientTasks(_this) {
        console.log(_this);
        let _url = $(_this).data('href');
        console.log(_url);
        window.location.href = _url;
    }

    function fetch_data(page) {
        $.ajax({
            url: "?page=" + page,
            success: function(data) {
                $('#patient-lists').html(data);
            }
        });
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
