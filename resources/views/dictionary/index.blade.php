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
                                            <a href="{{ route('dictionary.edit', $row->id) }}" class="btn btn-default">
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

    $(document).ready(function() {
        $('#addDataBtn').on('click', function() {
            window.location.href = "{{ route('dictionary.create') }}";
        });
    });
</script>

@endsection