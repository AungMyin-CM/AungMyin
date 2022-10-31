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
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br />
                                        @endif
                                        <div class="card-body">
                                            {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                            </p><br /> --}}

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="patient_name"
                                                            name="name" placeholder="Name" value="{{ old('name') }}">
                                                            <input type="hidden" id="clinic_id" value="{{session()->get('cc_id')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input class="form-control" placeholder="Code" name="code" id="code" value="{{ old('code') }}"/>
                                                        <span class="small" id="a-text"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="expire_date">Expire Date</label>
                                                        <input type="date" class="form-control" id="expire_date"
                                                            name="expire_date"
                                                            value="{{ old('expire_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                                            min="1" max="100" placeholder="Quantity" value="{{ old('quantity') }}">
                                                    </div>
                                                </div>
                                               
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="phoneNumber">Act Price</label>
                                                        <input type="text" class="form-control" id="act_price"
                                                            name="act_price" placeholder="Act Price"
                                                            value={{ old('act_price') }}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address">Sell price</label>
                                                        <input class="form-control" id="sell_price" placeholder="Sell price" name="sell_price" value="{{ old('sell_price') }}"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address">Margin</label>
                                                        <input class="form-control" id="margin" placeholder="Margin" name="margin" value="{{ old('margin') }}"/>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address">Unit</label>
                                                        <input class="form-control" placeholder="Unit" name="unit" value="{{ old('unit') }}"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address">Vendor</label>
                                                        <input class="form-control" placeholder="Summary" rows="4" name="vendor" value="{{ old('vendor') }}"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address">Vendor Phone-Number</label>
                                                        <input class="form-control" placeholder="Summary" rows="4" name="vendor_phone_number"  value="{{ old('vendor_phone_number') }}"/>                                                  </div>
                                                </div>

                                                

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Description</label>
                                                    <textarea class="form-control" placeholder="Description" rows="4"
                                                        name="description">{{ old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Storage Place</label>
                                                    <input class="form-control" placeholder="Storage Place" rows="4" name="storage_place">{{ old('storate_place') }}</textarea>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="card-footer" >
                                            <div class="form-group float-right">
                                                <input type="submit" value="submit" class="btn btn-primary" style="background-color:  {{config('app.color')}}">
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
        $("#code").blur(function(){

        var code = $('#code').val();
        var clinic_id = $("#clinic_id").val();
        var _token = $('input[name="_token"]').val();

        if(code.length >= 3){

            $.ajax({
                url:"{{ route('pharma_code.check') }}",
                method:"POST",
                data:{clinic_id:clinic_id,code:code, _token:_token},
                success:function(result)
                {
                    if(result == 'unique')
                    {
                    $('#a-text').removeClass('text-danger');
                    $('#a-text').removeClass('text-warning');
                    $('#a-text').addClass('text-success');
                    $('#a-text').text('Code available');
                    setTimeout(function(){
                        $('#a-text').hide();
                    }, 5000);
                    }
                    else
                    {
                    $('#a-text').removeClass('text-danger');
                    $('#a-text').removeClass('text-success');
                    $('#a-text').addClass('text-warning');
                    $('#a-text').text('Code Already taken');
                    setTimeout(function(){
                        $('#a-text').hide();
                    }, 5000);
                    }
                    
                }
            });
            }else{

            $('#a-text').removeClass('text-warning');
            $('#a-text').removeClass('text-success');
            $('#a-text').addClass('text-danger');
            $('#a-text').text('Must have at leat 3 characters');
            setTimeout(function(){
                $('#a-text').hide();
            }, 5000);
        }
            
        });
    </script>

@endsection
