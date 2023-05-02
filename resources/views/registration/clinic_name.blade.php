@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
                <div class="content-wrapper">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="container">
                                    <div class="package-grid">
                                        <div class="row mt-5">
                                            {{-- <div class="col-md-6 text-center" >
                                                <label class="package-card " style="background-color: #d8d6d6">
                                                    <p class="mt-2">Solo Practice </p>
                                                    <p  class="m-2">ဆရာဝန်တစ်ဦးတည်းထိုင်တဲ့</p>
                                                    <p> ဆေးခန်းအတွက်</p>
                                                    
                                                    <h3 class = "m-3 font-weight-bold ">၂၁၀၀၀ကျပ်/ဆေးခန်း</h3>
                                                    <p>ပထမဆုံး ၁လ ၁၀၀% Free</p>
                                                    <a href="{{route('clinic.info','_token='.Crypt::encrypt(1).'&value=1')}}" class="btn btn-info m-2" style="background-color: {{config('app.color')}}">Get Started</a>
                                                </label>
                                            </div> --}}
                                            <div class="col-md-12 text-center" >
                                                <label class="package-card " style="background-color: #d8d6d6">
                                                    <p class="m-3">{{$data['name']}}</p>
                                                    <p  class="m-2">ဆရာဝန်အများထိုင်တဲ့</p>
                                                    <p> ဆေးခန်းအတွက်</p>
                                                    
                                                    <h3 class = "m-3 font-weight-bold ">{{$data['price']}}ကျပ်/ဆေးခန်း</h3>
                                                    <p>ပထမဆုံး ၁လ ၁၀၀% Free</p>
                                                    <a href="{{route('clinic.info','_token='.Crypt::encrypt($data['id']).'&value=1')}}" class="btn btn-info m-2" style="background-color: {{config('app.color')}}">Get Started</a>
                                                </label>
                                            </div>

                                            
                                            {{-- @foreach ($data as $package)

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
                                                        <a href="{{route('clinic.info','_token='.Crypt::encrypt($package->id).'&value=1')}}" class="btn btn-info m-auto" style="background-color: {{config('app.color')}}">Start Your Free Trial</a>
                                                    </span>
                                                </label>

                                            @endforeach --}}
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
