@extends('layouts.app')
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
        <div class="content-wrapper" style="background-color: #fdfaf0 !important;">
            <section class="content m-auto">
                <div class="container-fluid">
                    <form action=" {{ route('clinic.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-4">
                            <div class=" col-md-6 m-auto">

                                <div class="card">
                                    <div class="card-header" style="background-color:{{config('app.color')}}">
                                        <h5 class="card-title text-white">Clinic Information</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="input-group m-auto">
                                                <input type="file" onchange="loadClinicLogo(event)" name="avatar" id="clinicLogoUpload" hidden />
                                                <label class="file_upload m-auto hover" for="clinicLogoUpload" id="clinicLogoContainer">
                                                    <img src="{{ asset('images/web-photos/sidebar-clinic-logo.png') }}" class="avatar img-thumbnail mb-2" alt="Clinic Logo" id="clinicLogoImage">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">

                                            <input type="hidden" class="form-control" name="package_id" id="package_id" value="{{ $data['package_id']}}">
                                            <div class="input-group">
                                                <input type="text" id="clinic_name" class="form-control" name="clinic_name" placeholder="Clinic Name" title="Name should contain atleast 5 characters" required autocomplete="off">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-clinic-medical"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="text-black">+95</span>
                                                </div>
                                            </div>
                                            <input type="tel" class="form-control" placeholder="09xxxxxxx" name="phoneNumber" required value="{{ old('phoneNumber') }}" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <textarea rows="5" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}" required autocomplete="off"></textarea>
                                            <div class="input-group-append">

                                            </div>
                                        </div>

                                        <!-- /.col -->
                                        <div class="float-right">
                                            <button type="submit" id="register" class="btn btn-primary px-5 btn-block" style="background-color: {{config('app.color')}}">Register</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                            </div>

                            @if($data['free_month'] != 1)
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
                            @endif
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    let selectedLogo = null;

    let loadClinicLogo = function(event) {
        if (event.target.files && event.target.files[0]) {
            let file = event.target.files[0];
            selectedLogo = file;
            let src = URL.createObjectURL(file);
            $('#clinicLogoImage').attr('src', src);
        }
    };

    $(document).ready(function() {
        $("input:radio[type=radio]").click(function() {
            var value = $(this).val();

            if (value == '1_k') {
                $("#payment").show();
                $('#back-img-kpay').show();
                $('#back-img-wpay').hide();

            } else if (value == '2_w') {
                $("#payment").show();
                $('#back-img-wpay').show();
                $('#back-img-kpay').hide();
            }


        });
    })
</script>

@endsection