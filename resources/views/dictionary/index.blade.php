@extends("layouts.app")
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Dictionary</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dictionary</li>
                                </ol>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    @if(Helper::checkPermission('d_create', $permissions))
                                        <div class="card-header">
                                            <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i
                                                    class="fas fa-plus"></i> Add new</a>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Meaning</th>
                                                    <th colspan="2" style="width:15%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($data as $row)
                                                    <tr>
                                                        <td>{{ $i++ }} </td>
                                                        <td>{{ $row->code }}</td>
                                                        <td><?php echo Str::limit(str_replace("^" , " " ,$row->meaning ) , $limit = 100, $end = '...') ?>
                                                        </td>
                                                        @if(Helper::checkPermission('d_update', $permissions))
                                                            <td><a href="{{ route('dictionary.edit', $row->id) }}" class="btn btn-default">
                                                                 <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i></a>
                                                            </td>
                                                        @endif
                                                        @if(Helper::checkPermission('d_delete', $permissions))
                                                            <td>
                                                                <form action="{{ route('dictionary.destroy', $row->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                                </form>
                                                            </td>
                                                            
                                                        @endif
                                                    </tr>
                                                @endforeach

                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
@endsection
