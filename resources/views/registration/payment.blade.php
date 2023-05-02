@extends('layouts.app')
@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="mydiv">
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">   
                        <form action="{{ route('clinic.register') }}" method="POST">
                            @csrf  
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Information ({{$data['name']}})</label>

                                        <input type="hidden" class="form-control" name="package_id" id="package_id"
                                        value="{{ $data['package_id'] }}">
                                        <input type="hidden" class="form-control" name="name" id="clinic_input_name"
                                        value="{{ $data['name'] }}">

                    
                                        <div class="input-group mb-3">
                                            
                                            <input type="hidden" class="form-control" name="package_id" id="package_id"
                                                value="{{ $data['package_id']}}">
                                            <input type="hidden" class="form-control" name="name" id="clinic_input_name"
                                                value="{{ $data['name'] }}">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="clinic_name" class="form-control" name="clinic_name" placeholder="Name"
                                                        title="Name should contain atleast 5 characters" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-clinic-medical"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-clinic-medical"></span>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="input-group mb-3">
                                            <span class="badge badge-success" style="{{ $data['style'] }}"
                                                onclick="$('#clinic_code').val('{{ $data['clinicCode1'] }}' )">{{ $data['clinicCode1'] }}</span>&nbsp;
                                            <span class="badge badge-success" style="{{ $data['style'] }}"
                                                onclick="$('#clinic_code').val('{{ $data['clinicCode2'] }}' )">{{ $data['clinicCode2'] }}</span>&nbsp;
                                            <span class="badge badge-success" style="{{ $data['style'] }}"
                                                onclick="$('#clinic_code').val('{{ $data['clinicCode3'] }}' )">{{ $data['clinicCode3'] }}</span>
                                        </div> --}}
                                        <div class="input-group mb-3">
                                            <input type="tel" class="form-control" placeholder="Phone Number" name="phoneNumber" required
                                                value={{ old('phoneNumber') }} >
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea rows="5" class="form-control" placeholder="Address" name="address"
                                                value="{{ old('address') }}" required></textarea>
                                            <div class="input-group-append">
                
                                            </div>
                                        </div>
                
                                        <!-- /.col -->
                                        <div class="col-4 float-right">
                                            <button type="submit" id="register" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                            <!-- /.col -->
                                    </div>
                                    <div class="col-md-6">
                                        <label>Payments</label>

                                        <div class="package-grid">
                                            <div class="row m-auto ">

                                                <label class="package-card m-4">
                                                    <input name="payment_type" class="radio" type="radio" value="1_k">
                                                    
                                                    <span class="plan-details">
                                                        <span class="plan-cost">KPay</span>
                                                    </span>
                                                </label>

                                                <label class="package-card m-4">
                                                    <input name="payment_type" class="radio" type="radio" value="2_w">
                                                    
                                                    <span class="plan-details">
                                                        <span class="plan-cost">Wave Pay</span>
                                                    </span>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="container" id="payment" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="acc_name">Account Name</label>
                                                    <input type="text" name="account_name" id="acc_name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="acc_name">Phone Number</label>
                                                    <input type="text" name="account_name" id="acc_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="package-card m-4">
                                                    <input name="timeline" class="radio" type="radio" value="1">
                                                    
                                                    <span class="plan-details">
                                                        <span class="plan-cost">1 Month</span>
                                                    </span>
                                                </label>

                                                <label class="package-card m-4">
                                                    <input name="timeline" class="radio" type="radio" value="3">
                                                    
                                                    <span class="plan-details">
                                                        <span class="plan-cost">3 Months</span>
                                                    </span>
                                                </label>

                                                <label class="package-card m-4">
                                                    <input name="timeline" class="radio" type="radio" value="6">
                                                    
                                                    <span class="plan-details">
                                                        <span class="plan-cost">6 Months</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="text-white" style="display:none;height:17rem;border:1px solid #808080;background-image:url({{asset('images/payments/kpay.png')}});" id="back-img-kpay">
                                            </div>
                                            <div class="text-white" style="display:none;height:17rem;border:1px solid #808080;background-image:url({{asset('images/payments/wave-money.png')}}" id="back-img-wpay">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

        <script type="text/javascript">

            $(document).ready(function(){
                $("input:radio[type=radio]").click(function() {
                var value = $(this).val();
               
                if(value == '1_k')
                    {
                        $("#payment").show();
                        $('#back-img-kpay').show();
                        $('#back-img-wpay').hide();

                    }
                else if(value == '2_w')
                    {
                        $("#payment").show();
                        $('#back-img-wpay').show();
                        $('#back-img-kpay').hide();
                    }
                
                
                 });
            })
        </script>

@endsection
