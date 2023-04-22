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
                                <h1>History</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">History</li>
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
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered table-striped">                                    
                                          <thead>
                                            <tr>
                                                <th>Invoice code</th>
                                                <th>Patient name</th>
                                                <th>Total price</th>
                                                <th>Payment status</th>
                                                <th>Actions</th>
                                                {{-- <th></th>
                                                <th></th> --}}
                                                {{-- <th colspan="3" style="width:15%;">Actions</th> --}}
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
                                                        <div class="row">
                                                            @if(Helper::checkPermission('pos_update', $permissions))

                                                                <a href="{{ route('pos.edit' ,  Crypt::encrypt($row->id)) }}" style="margin:10px ;">
                                                                <i class="fas fa-edit fa-lg"></i></a>

                                                            @endif
                                                            @if(Helper::checkPermission('pos_delete', $permissions))

                                                                <form action="{{ route('pos.destroy', $row->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')   
                                                                    <button class="" type="submit" style="margin:5px;"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                                                                </form>

                                                            @endif
                                                                <a href="{{route('pos-invoice',Crypt::encrypt($row->id))}}" style="margin:10px;">
                                                                <i class="fas fa-print fa-lg"></i></a>
                                                        </div>
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

       
