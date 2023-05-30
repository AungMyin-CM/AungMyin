@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <section class="content">
                <div class="container-fluid">
                    @if (Session::has('success'))
                    <div class="alert text-white mt-3" style="background-color: {{config('app.color')}} !important">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                @if(Helper::checkPermission('d_create', $permissions))
                                <div class="card-header">
                                    <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
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
                                                <td><?php echo Str::limit(str_replace("^", " ", $row->meaning), $limit = 100, $end = '...') ?>
                                                </td>
                                                @if(Helper::checkPermission('d_update', $permissions))
                                                <td><a href="{{ route('dictionary.edit', $row->id) }}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg" style=" color: {{config('app.color')}}"></i></a>
                                                </td>
                                                @endif
                                                @if(Helper::checkPermission('d_delete', $permissions))
                                                <td>
                                                    <form action="{{ route('dictionary.destroy', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                    </form>
                                                </td>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    @if(Helper::checkPermission('d_create', $permissions))
                                        <div class="card-header">
                                            <div class="float-left">
                                                
                                            </div>
                                            <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i
                                                    class="fas fa-plus"></i> Add new</a>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Meaning</th>
                                                    {{-- <th colspan="2" style="width:15%;">Actions</th> --}}
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
                                    </div>
                                    <!-- /.card-body -->
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
<script>
    // Alert Box
    setInterval(function() {
        $(".alert").fadeOut();
    }, 3000);
</script>
@endsection