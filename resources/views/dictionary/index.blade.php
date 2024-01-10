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

                        @if(Helper::checkPermission('d_create', $permissions))
                        <div class="col-6">
                            <span data-href="/clinic-system/exportDictionaryCSV" id="export" class="btn btn-success btn-sm float-left mr-2" onclick="exportDictionaryTasks(event.target);"><i data-href="/clinic-system/exportDictionaryCSV" class="fas fa-download"></i></span>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form method="post" action="{{ route('dictionary.excel.import') }}" enctype="multipart/form-data" class="float-left d-flex" style="gap: 1px;">
                                @csrf
                                @method('post')

                                <!-- Import Excel File -->
                                <div class="import-container">
                                    <input type="file" id="excel-file-input" name="dictionary_excel" accept=".xls, .xlsx" style="display:none" required />
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

                        <div class="col-sm-6">
                            @if(count($data) !== 0)
                            <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}">
                                <i class="fas fa-plus"></i> Add new
                            </a>
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
                    @if(Helper::checkPermission('d_create', $permissions))
                    @endif

                    <table id="dictionaryTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Meaning</th>
                                <th style="width: 10%;"><span class="d-none d-md-block">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $row->code }}</td>
                                @if($row->isMed != 1)
                                    <td>
                                        <?php echo Str::limit( $row->meaning, $limit = 100, $end = '...') ?>
                                    </td>
                                @else
                                    <td>
                                        <span class="show">
                                            @php

                                              $med = explode('<br>',preg_replace('/(<br>)+$/', '', $row->meaning));

                                              $medInfo = [];

                                              foreach ($med as $key =>$medRow) {
                                                $medInfo[] = explode("^", $medRow);
                                              }

                                              $amount = 0;

                                                foreach($medInfo as $key => $d){
                                                  echo '<span class="badge badge-primary">'.$d[1].' </span> <span class="badge badge-secondary">'.$d[2].' </span> <span class="badge badge-info">'.$d[3].' </span><br/>';
                                                }


                                            @endphp</span>
                                    </td>
                                @endif
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 20px">
                                        <div>
                                            @if(Helper::checkPermission('d_update', $permissions))
                                            <a href="{{ route('dictionary.edit', Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i>
                                            </a>
                                            @endif
                                        </div>

                                        <div>
                                            @if(Helper::checkPermission('d_delete', $permissions))
                                            <form action="{{ route('dictionary.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
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
<!-- Datatable -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>
    new DataTable("#dictionaryTable", {
        responsive: true,
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search shorthand...",
            search: "",
            emptyTable: "No data available in table.<br><br><button id='addDataBtn' class='btn text-white addDataBtn'><i class='fas fa-plus'></i> Add new</button>"
        },
    });


    function exportDictionaryTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }

    $(document).ready(function() {
        $('#addDataBtn').on('click', function() {
            window.location.href = "{{ route('dictionary.create') }}";
        });
    });

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
