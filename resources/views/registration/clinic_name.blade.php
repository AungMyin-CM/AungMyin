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
                                            {{-- <div class="col-md-12 text-center" >
                                                <label class="package-card " style="background-color: #d8d6d6">
                                                    <p class="m-3">{{$data['name']}}</p>
                                                    <p  class="m-2">ဆရာဝန်အများထိုင်တဲ့</p>
                                                    <p> ဆေးခန်းအတွက်</p>
                                                    
                                                    <h3 class = "m-3 font-weight-bold ">{{$data['price']}}ကျပ်/ဆေးခန်း</h3>
                                                    <p>ပထမဆုံး ၁လ ၁၀၀% Free</p>
                                                    <a href="{{route('clinic.info','_token='.Crypt::encrypt($data['id']).'&value=1')}}" class="btn btn-info m-2" style="background-color: {{config('app.color')}}">Get Started</a>
                                                </label>
                                            </div> --}}
                                            <div class="section bg-transparent my-0 my-lg-5 pb-0 pb-lg-5">
                                                <div class="container m-auto">
                            
                                                {{-- <h3 class="h1 mb-5 text-center">Our Packages</h3> --}}
                            
                                                <div class="row pricing block-pricing-10 justify-content-center align-items-stretch">
                                                    @foreach($data as $clinic)
                                                        <div class="col-lg-6 col-md-6 mb-5 mb-lg-0">
                                                            <div class="pricing-box d-flex flex-column justify-content-between align-items-center h-100 rounded-5 pricing-simple px-5 py-0 border text-center bg-white overflow-visible">
                                                                <h3 class="pricing-title ls-0 bg-white fw-normal">{{$clinic->name}}</h3>
                                                                <div class="pricing-price fw-medium"><span class="price-unit"></span>Free</div>
                                                                <div class="pricing-features">
                                                                    <h5 class="mb-2 fw-semibold">Plan Includes:</h5>
                                                                    <ul class="d-flex flex-column align-items-center justify-content-center">
                                                                        <li>Full Access of all Features</li>
                                                                        <li>Upto 100 User Accounts Access</li>
                                                                        <li>1 Year License Available</li>
                                                                        <li>24/7 Support with Chats</li>
                                                                    </ul>
                                                                </div>
                                                                @if($clinic->type == 'one-month-free-trial')
                                                                    <a href="#" class="btn btn-action border bg-white h-bg-dark text-dark h-text-light btn-lg px-4">Free Trail for 30 Days</a>
                                                                @else
                                                                <a href="#" class="btn btn-action btn-warning btn-lg px-4 mt-auto">Buy Now</a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @endforeach
                            
                                                    {{-- <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                                        <div class="pricing-box d-flex flex-column justify-content-between align-items-center h-100 rounded-5 pricing-simple px-5 py-0 border border-width-2 border-color text-center bg-white overflow-visible">
                                                            <h3 class="pricing-title ls-0 bg-white color">Business</h3>
                                                            <div class="pricing-price fw-medium"><span class="price-unit">&euro;</span>49<span class="price-tenure">/monthly</span></div>
                                                            <div class="pricing-features">
                                                                <h5 class="mb-2 fw-semibold">Plan Includes:</h5>
                                                                <ul class="d-flex flex-column align-items-center justify-content-center">
                                                                    <li>Full Access of all Features</li>
                                                                    <li>Upto 100 User Accounts Access</li>
                                                                    <li>1 Year License Available</li>
                                                                    <li>24/7 Support with Chats</li>
                                                                </ul>
                                                            </div>
                                                            <a href="#" class="btn btn-dark btn-action bg-secondary btn-lg px-4">Subscribe Now</a>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                                        <div class="pricing-box d-flex flex-column align-items-center h-100 rounded-5 pricing-simple px-5 py-0 border text-center bg-white overflow-visible">
                                                            <h3 class="pricing-title ls-0 bg-white fw-normal">Professional</h3>
                                                            <div class="pricing-price fw-medium"><span class="price-unit">&euro;</span>99<span class="price-tenure">/monthly</span></div>
                                                            <div class="pricing-features">
                                                                <h5 class="mb-2 fw-semibold">Plan Includes:</h5>
                                                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing, elit. Nobis enim iure veritatis consectetur. Sequi fuga, qui unde dolore laudantium fugiat iste facilis.</p>
                                                            </div>
                                                            <a href="#" class="btn btn-action btn-warning btn-lg px-4 mt-auto">Contact Us</a>
                                                        </div>
                                                    </div> --}}
                            
                                                </div>
                            
                                            </div>
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
