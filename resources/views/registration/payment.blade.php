@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
                <div class="content-wrapper">
                    <section class="content">
                        <div class="container-fluid">     
                            <div class="container">
                                     
                                   <label> Complete your Payment</label>
                                   <form action="{{ route('clinic.register') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" name="package_id" id="package_id"
                                    value="{{ $data['package_id'] }}">
                                     <input type="hidden" class="form-control" name="name" id="clinic_input_name"
                                    value="{{ $data['name'] }}">
                                    <div class="col-4 float-right">
                                        <button type="submit" id="register" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </form>
                            </div>
                         
                        </div>
                    </section>
                </div>
            </div>

        

        </body>

@endsection
