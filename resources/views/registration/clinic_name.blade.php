@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
                <div class="content-wrapper">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="container">
                                    <div class="package-grid">
                                        <div class="row m-auto">
                                            @foreach ($data as $package)

                                                <label class="package-card m-4">
                                                
                                                    <span class="plan-details">
                                                        <span class="plan-type">{{ $package->name }}</span>
                                                        <span class="plan-cost">{{ $package->price }}<span class="slash">/</span><abbr class="plan-cycle" title="month">mo</abbr></span>
                                                        <span>1 team member:</span>
                                                        <span>100 GB/mo</span>
                                                        <span>1 concurrent build</span>
                                                        <span>1 team member:</span>
                                                        <span>100 GB/mo</span>
                                                        <span>1 concurrent build</span> <span>1 team member:</span>
                                                        <span>100 GB/mo</span>
                                                        <span>1 concurrent build</span> <span>1 team member:</span>
                                                        <span>100 GB/mo</span>
                                                        <span>1 concurrent build</span>
                                                        <a href="{{route('clinic.info','_token='.Crypt::encrypt($package->id).'&value=1')}}" class="btn btn-info m-auto">Start Your Free Trial</a>
                                                    </span>
                                                </label>

                                            @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- /.register-box -->
            <!-- jQuery -->

        </body>

@endsection
