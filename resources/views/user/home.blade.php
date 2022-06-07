@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="float-right mt-4">
                        <a href="{{route('clinic.name')}}" class="btn btn-success">Create a new clinic</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
@endsection