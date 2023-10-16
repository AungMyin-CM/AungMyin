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
                        <div class="col-6">
                            <ul class="nav nav-tabs small" id="myTab" role="tablist" style="border-bottom: none;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="procedure-tab" data-toggle="tab" data-target="#procedure" type="button" role="tab" aria-controls="procedure" aria-selected="true">
                                        <i class="fas fa-procedures"></i>
                                        <span class="d-none d-md-inline">Procedure</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="investigation-tab" data-toggle="tab" data-target="#investigation" type="button" role="tab" aria-controls="investigation" aria-selected="false">
                                        <i class="fas fa-flask"></i>
                                        <span class="d-none d-md-inline">Investigation</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            @if(Helper::checkPermission('d_create', $permissions))
                            @if(count($data) !== 0 || count($investigations) !== 0)
                            <a href="{{ route('procedure.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}">
                                <i class="fas fa-plus"></i> Add new
                            </a>
                            @endif
                            @endif
                        </div>
                    </div>

                    @if (Session::has('success'))
                    @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->
            </section>

            <section class="content mb-3">
                <div class="container-fluid">

                    <div class="tab-content">
                        <div class="tab-pane active" id="procedure" role="tabpanel" aria-labelledby="procedure-tab">
                            <label for="procedure">Procedure</label>

                            <table id="procedureTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $row->code }}</td>
                                        <td><?php echo Str::limit(str_replace("^", "<br/>", $row->name), $limit = 100, $end = '...') ?>
                                        </td>
                                        <td><?php echo Str::limit(str_replace("^", "<br/>", $row->price), $limit = 100, $end = '...') ?>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center" style="gap: 20px">
                                                <div>
                                                    @if(Helper::isAdmin())
                                                    <a href="{{ route('procedure.edit', Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i></a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if(Helper::isAdmin())
                                                    <form action="{{ route('procedure.destroy', Crypt::encrypt($row->id)) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-default" type="submit" id="delete_procedure"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
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

                        <div class="tab-pane" id="investigation" role="tabpanel" aria-labelledby="investigation-tab">
                            <label for="procedure">Investigation</label>

                            <table id="investigationTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($investigations as $row)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $row->code }}</td>
                                        <td><?php echo Str::limit(str_replace("^", "<br/>", $row->name), $limit = 100, $end = '...') ?>
                                        </td>
                                        <td><?php echo Str::limit(str_replace("^", "<br/>", $row->price), $limit = 100, $end = '...') ?>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center" style="gap: 20px">
                                                <div>
                                                    @if(Helper::isAdmin())
                                                    <a href="{{ route('investigation.edit', Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i></a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if(Helper::isAdmin())
                                                    <form action="{{ route('investigation.destroy', Crypt::encrypt($row->id)) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-default" type="submit" id="delete_btn"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
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
                    </div>
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
    new DataTable("#procedureTable", {
        responsive: true,
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search ...",
            search: "",
            emptyTable: "No data available in table.<br><br><button id='addDataBtn' class='btn text-white addDataBtn'><i class='fas fa-plus'></i> Add new</button>"
        },
    });

    new DataTable("#investigationTable", {
        responsive: true,
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search ...",
            search: "",
            emptyTable: "No data available in table.<br><br><button id='addDataBtn' class='btn text-white addDataBtn'><i class='fas fa-plus'></i> Add new</button>"
        },
    });

    $(document).ready(function() {
        $('.addDataBtn').on('click', function() {
            window.location.href = "{{ route('procedure.create') }}";
        });
    });

    $("#delete_btn").click(function() {
        if (!confirm("Do you want to delete")) {
            return false;
        }
    });
</script>
@endsection