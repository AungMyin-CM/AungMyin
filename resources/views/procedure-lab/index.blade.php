@extends("layouts.app")
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  
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
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    @if(Helper::checkPermission('d_create', $permissions))
                                        <div class="card-header">
                                            <div class="float-left">
                                            </div>
                                            <a href="{{ route('procedure.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i
                                                    class="fas fa-plus"></i> Add new</a>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="card-body col-md-6">
                                            <label for="procedure">Procedure</label>

                                            <div class="table-responsive" style="margin:0px auto;">
                                                <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th colspan="2" style="width:15%;"></th>
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
                                                            @if(Helper::isAdmin())
                                                                <td><a href="{{ route('procedure.edit', $row->id) }}" class="btn btn-default">
                                                                    <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i></a>
                                                                </td>
                                                            @endif
                                                            @if(Helper::isAdmin())
                                                                <td>
                                                                    <form action="{{ route('procedure.destroy', $row->id) }}"
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
                                        </div>
                                        <div class="card-body col-md-6">
                                            <label for="procedure">Investigation</label>

                                            <div class="table-responsive" style="margin:0px auto;">
                                                <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th colspan="2" style="width:15%;"></th>
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
                                                            @if(Helper::isAdmin())
                                                                <td><a href="{{ route('investigation.edit', $row->id) }}" class="btn btn-default">
                                                                    <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"  ></i></a>
                                                                </td>
                                                            @endif
                                                            @if(Helper::isAdmin())
                                                                <td>
                                                                    <form action="{{ route('investigation.destroy', $row->id) }}"
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
                                        </div>
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
