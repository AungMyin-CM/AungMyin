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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user.clinic', Crypt::encrypt(session() -> get('cc_id'))) }}">Home</a></li>
                                <li class="breadcrumb-item active">Patient</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('patient.create') }}" class="btn float-right" style="color:{{config('app.secondary_color')}}; background-color: {{config('app.color')}}"><i class="fas fa-plus"></i> Add new</a>
                        </div>
                    </div>

                    @if (Session::has('success'))
                    @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->

            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- /.card-header -->
                    @if(Helper::checkPermission('p_create', $permissions))
                    <div class="pb-5">
                        <span data-href="/clinic-system/exportPatientCSV" id="export" class="btn btn-success btn-sm float-left" onclick="exportTasks(event.target);">Export</span>

                        <form method="post" action="{{ route('patient.import') }}" enctype="multipart/form-data" class="float-left">
                            @csrf
                            <input type="file" name="importFile" id="importFile" accept=".csv" class="inputfile" required />
                            <label for="importFile">Choose a file....</label>
                            <input type="submit" value="Import" name="import" class="btn btn-success btn-sm" style="background: {{config('app.color')}};
                                color:white;
                                border-radius: 5px;
                                cursor: pointer;" />
                        </form>
                    </div>
                    @endif

                    <div id="patient-lists">
                        @include('partials._patient-card')
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }

    // Ajax Pagination
    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    });

    function fetch_data(page) {
        $.ajax({
            url: "?page=" + page,
            success: function(data) {
                $('#patient-lists').html(data);
            }
        });
    }
</script>
@endsection