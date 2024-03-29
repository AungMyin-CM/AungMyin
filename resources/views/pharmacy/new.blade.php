@extends("layouts.app")

@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <form action="{{ route('pharmacy.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 py-2">
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color:  {{config('app.color')}}">
                                        <h3 class="card-title">New Medicine</h3>
                                    </div>

                                    <div class="card-body">
                                        {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                        </p><br /> --}}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="patient_name" name="name" value="{{ old('name') }}" autocomplete="off">
                                                    <input type="hidden" id="clinic_id" value="{{session()->get('cc_id')}}">
                                                    @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="code">Code</label>
                                                    <input class="form-control" name="code" id="code" value="{{ old('code') }}" autocomplete="off" />
                                                    <span class="small" id="a-text"></span>
                                                    @error('code') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expire_date">Expire Date</label>
                                                    <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ old('expire_date') }}">
                                                    @error('expire_date') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="10000" value="{{ old('quantity') }}" autocomplete="off">
                                                    @error('quantity') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phoneNumber">Act Price</label>
                                                    <input type="text" class="form-control" id="act_price" name="act_price" value="{{ old('act_price') }}" autocomplete="off">
                                                    @error('act_price') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Sell price</label>
                                                    <input class="form-control" id="sell_price" name="sell_price" value="{{ old('sell_price') }}" autocomplete="off" />
                                                    @error('sell_price') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Margin</label>
                                                    <input class="form-control" id="margin" name="margin" value="{{ old('margin') }}" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Unit</label>
                                                    <select name="unit" id="unit" class="form-control" >
                                                        <option value="" selected disabled>Select</option>
                                                        <option value="Syrup">Syrup</option>
                                                        <option value="Tablet">Tablet</option>
                                                        <option value="Capsules">Capsules</option>
                                                        <option value="Cream">Cream</option>
                                                        <option value="Ointment">Ointment</option>
                                                        <option value="Suppsitories">Suppsitories</option>
                                                        <option value="Drops">Drops</option>
                                                        <option value="Inhaler">Inhaler</option>
                                                        <option value="Injection">Injection</option>
                                                    </select>
                                                    @error('unit') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Vendor</label>
                                                    <input class="form-control" rows="4" name="vendor" value="{{ old('vendor') }}" autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Vendor Phone-Number</label>
                                                    <input class="form-control" rows="4" name="vendor_phone_number" value="{{ old('vendor_phone_number') }}" autocomplete="off"/>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Description</label>
                                                <textarea class="form-control" rows="4" name="description" autocomplete="off">{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Storage Place</label>
                                                <input class="form-control" rows="4" name="storage_place" autocomplete="off">{{ old('storate_place') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="form-group float-right">
                                            <input type="submit" value="Submit" class="btn btn-primary" style="background-color:  {{config('app.color')}}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                </section>
            </form>

        </div>
    </div>
</body>
<script src="{{ asset('js/pharmacy.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $("#code").blur(function() {

        var code = $('#code').val();
        var clinic_id = $("#clinic_id").val();
        var _token = $('input[name="_token"]').val();

        if (code.length >= 3) {

            $.ajax({
                url: "{{ route('pharma_code.check') }}",
                method: "POST",
                data: {
                    clinic_id: clinic_id,
                    code: code,
                    _token: _token
                },
                success: function(result) {
                    if (result == 'unique') {
                        $('#a-text').removeClass('text-danger');
                        $('#a-text').removeClass('text-warning');
                        $('#a-text').addClass('text-success');
                        $('#a-text').text('Code available');
                        setTimeout(function() {
                            $('#a-text').hide();
                        }, 5000);
                    } else {
                        $('#a-text').removeClass('text-danger');
                        $('#a-text').removeClass('text-success');
                        $('#a-text').addClass('text-warning');
                        $('#a-text').text('Code Already taken');
                        setTimeout(function() {
                            $('#a-text').hide();
                        }, 5000);
                    }

                }
            });
        } else {

            $('#a-text').removeClass('text-warning');
            $('#a-text').removeClass('text-success');
            $('#a-text').addClass('text-danger');
            $('#a-text').text('Must have at leat 3 characters');
            setTimeout(function() {
                $('#a-text').hide();
            }, 5000);
        }
    });
</script>

@endsection