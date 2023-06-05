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
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice code</th>
                                                <th>Patient name</th>
                                                <th>Total price</th>
                                                <th>Payment status</th>
                                                <!-- <th>Actions</th> -->
                                                <th colspan="3" style="width:15%;">Actions</th>
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
                                                    @if(Helper::checkPermission('pos_update', $permissions))
                                                    <a href="{{ route('pos.edit' ,  Crypt::encrypt($row->id)) }}" class="btn btn-default">
                                                        <i class="fas fa-edit fa-lg"></i></a>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(Helper::checkPermission('pos_delete', $permissions))
                                                    <form action="{{ route('pos.destroy', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                    </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{route('pos-invoice',Crypt::encrypt($row->id))}}" class="btn btn-default">
                                                        <i class="fas fa-print fa-lg"></i></a>
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

@endsection