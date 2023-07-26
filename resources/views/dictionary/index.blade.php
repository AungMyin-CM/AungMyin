@extends("layouts.app")
@section('content')

<style>
    .pagination .active .page-link {
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
                            <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}">
                                <i class="fas fa-plus"></i> Add new
                            </a>                      
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

                    <table id="dictionaryTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Meaning</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>{{ $row->code }}</td>
                                    <td>
                                        <?php echo Str::limit(str_replace("^" , " " ,$row->meaning ) , $limit = 100, $end = '...') ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center" style="gap: 20px">
                                            <div>
                                                @if(Helper::checkPermission('d_update', $permissions))
                                                    <a href="{{ route('dictionary.edit', $row->id) }}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i>
                                                    </a>
                                                @endif
                                            </div>

                                            <div>
                                                @if(Helper::checkPermission('d_delete', $permissions))
                                                    <form action="{{ route('dictionary.destroy', $row->id) }}"
                                                        method="post">
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    let table = new DataTable("#dictionaryTable", {
        "paging": true,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search shorthand...",
            search: "",
        },
    });
</script>

@endsection