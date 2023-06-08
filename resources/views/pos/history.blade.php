@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.clinic', Crypt::encrypt(session() -> get('cc_id'))) }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pos.index') }}">POS</a></li>
                        <li class="breadcrumb-item active">History</li>
                    </ol>
                    @if (Session::has('success'))
                        @include('partials._toast')
                    @endif
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">                    
                    <table id="posTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Invoice code</th>
                                <th>Patient name</th>
                                <th>Total price</th>
                                <th>Payment status</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history_list as $row)
                            <tr>
                                <td>{{ $row->invoice_code }}<span class="text-muted small float-right">{{$row->updated_at->diffForHumans()}}</span></td>
                                <td>{{ $row->customer_name }}</td>
                                <td>{{ $row->total_price }}</td>
                                <td>{{$row->payment_status == 1 ? "Paid" : ( $row->payment_status == 2 ? "Partial Paid" : "FOC" )  }}</td>

                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 20px">
                                        <div>
                                            @if(Helper::checkPermission('pos_update', $permissions))
                                            <a href="{{ route('pos.edit' ,  Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                <i class="fas fa-edit fa-lg"></i></a>
                                            @endif
                                        </div>
                                        <div>
                                            @if(Helper::checkPermission('pos_delete', $permissions))
                                            <form action="{{ route('pos.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{route('pos-invoice',Crypt::encrypt($row->id))}}" class="btn btn-default">
                                                <i class="fas fa-print fa-lg"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right p-2">
                        {{ $history_list->links('pagination.bootstrap-4') }}
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable("#posTable", {
        "paging": false,
        "info": false,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search medicine...",
            search: "",
        },
    });

    $('#fileUpload').change(function(e) {

        console.log(e.target.files[0])

    });

    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>

@endsection