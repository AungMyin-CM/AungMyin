@extends("layouts.app")
@section('content')

<style>
    .pagination .active .page-link {
        background-color: #003049;
    }

    .pagination .active {
        z-index: 0;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @if (Session::has('success'))
                @include('partials._toast')
                @endif
            </section>

            <section class="content mb-3">
                <div class="container-fluid">
                    <table id="posTable" class="table table-striped table-bordered mb-3 nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="display: none;">Updated at</th>
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
                                <td style="display: none;">{{ $row->updated_at }}</td>
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
    new DataTable("#posTable", {
        responsive: true,
        "paging": true,
        "info": false,
        "order": [0, 'desc'],
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search medicine...",
            search: "",
        },
    });
</script>

@endsection