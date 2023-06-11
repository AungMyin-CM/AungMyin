@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user.clinic', Crypt::encrypt(session() -> get('cc_id'))) }}">Home</a></li>
                                <li class="breadcrumb-item active">Procedure-Lab</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('procedure.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}">
                                <i class="fas fa-plus"></i> Add new
                            </a>      
                        </div>
                    </div>
                    
                    @if (Session::has('success'))
                        @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->                  
            </section>

            @if (Session::has('success'))
                <div class="col-md-6">
                    <div class="alert alert-success" id="alert-message">
                        <ul class="list-unstyled">
                            <li>
                                {{ Session::get('success') }}
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            <section class="content">
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
                                            <td><?php echo Str::limit(str_replace("^" , "<br/>" ,$row->name ) , $limit = 100, $end = '...') ?>
                                            </td>
                                            <td><?php echo Str::limit(str_replace("^" , "<br/>" ,$row->price ) , $limit = 100, $end = '...') ?>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center" style="gap: 20px">
                                                    <div>
                                                        @if(Helper::isAdmin())
                                                            <a href="{{ route('procedure.edit', $row->id) }}" class="btn btn-default">
                                                            <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i></a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if(Helper::isAdmin())
                                                            <form action="{{ route('procedure.destroy', $row->id) }}"
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
                                            <td><?php echo Str::limit(str_replace("^" , "<br/>" ,$row->name ) , $limit = 100, $end = '...') ?>
                                            </td>
                                            <td><?php echo Str::limit(str_replace("^" , "<br/>" ,$row->price ) , $limit = 100, $end = '...') ?>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center" style="gap: 20px">
                                                    <div>
                                                        @if(Helper::isAdmin())
                                                            <a href="{{ route('investigation.edit', $row->id) }}" class="btn btn-default">
                                                            <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i></a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if(Helper::isAdmin())
                                                            <form action="{{ route('investigation.destroy', $row->id) }}"
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<script>
    new DataTable("#procedureTable", {
        "paging": false,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search procedure...",
            search: "",
        },
    });

    new DataTable("#investigationTable", {
        "paging": false,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search investigation...",
            search: "",
        },
    });
</script>
@endsection
