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
                                @if(Helper::checkPermission('ph_create', $permissions))
                                <div class="card-header">
                                    <span data-href="/clinic-system/exportMedCSV" id="export" class="btn btn-success btn-sm float-left" onclick="exportTasks(event.target);">Export</span>

                                    <form method="post" action="{{ route('pharmacy.import') }}" enctype="multipart/form-data" class="float-left">
                                        @csrf
                                        <input type="file" name="importFile" id="importFile" accept=".csv" class="inputfile" required />
                                        <label for="importFile">Choose a file....</label>
                                        <input type="submit" value="Import" name="import" class="btn btn-success btn-sm" style="background: {{config('app.color')}}; color:white; border-radius: 5px; cursor: pointer;" />
                                    </form>

                                    <a href="{{ route('pharmacy.create') }}" class="btn btn-primary float-right" style="background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                                </div>
                                @endif
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Expire Date</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <!-- <th>Actions</th> -->
                                                <th colspan="2" style="width:15%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->code }}</td>
                                                <td>{{ $row->expire_date }}</td>
                                                <td>{{ $row->quantity }}</td>
                                                <td>{{ $row->status == '1' ? 'active' : 'inactive' }}</td>
                                                <td>
                                                    @if(Helper::checkPermission('ph_update', $permissions))
                                                    <a href="{{ route('pharmacy.edit' ,  Crypt::encrypt($row->id)) }}" class="btn btn-default" style="color: {{config('app.color')}}">
                                                        <i class="fas fa-edit fa-lg"></i></a>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(Helper::checkPermission('ph_delete', $permissions))
                                                    <form action="{{ route('pharmacy.destroy', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A; "></i></button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    // Alert Box
    setInterval(function() {
        $(".alert").fadeOut();
    }, 3000);

    $('#fileUpload').change(function(e) {

        console.log(e.target.files[0])

    });

    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>
@endsection