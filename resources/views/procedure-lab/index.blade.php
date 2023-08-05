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
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            @if(count($data) !== 0 || count($investigations) !== 0)
                            <a href="{{ route('procedure.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}">
                                <i class="fas fa-plus"></i> Add new
                            </a>
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
                    @if(Helper::checkPermission('d_create', $permissions))
                    <div class="float-left"></div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <label for="procedure">Procedure</label>

                            <table id="procedureTable" class="table table-striped table-bordered mb-3">
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
                        <div class="col-md-6">
                            <label for="procedure">Investigation</label>

                            <table id="investigationTable" class="table table-striped table-bordered mb-3">
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    new DataTable("#procedureTable", {
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