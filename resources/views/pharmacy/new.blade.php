@extends("layouts.app")

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <form action="{{ route('pharmacy.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
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

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input class="form-control" placeholder="Code" name="code" value="{{ old('code') }}"/>
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

                                        <div class="card-footer" style="background:rgb(221, 231, 207);">
                                            <div class="form-group float-right">
                                                <input type="submit" value="submit" class="btn btn-primary">
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

@endsection
