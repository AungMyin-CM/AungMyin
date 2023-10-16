@extends("layouts.app")

@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <form method="post" action="{{ route('pharmacy.update', $pharmacy->id) }}">
                @csrf
                @method('PATCH')

                <section class="content-header"></section>
                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="card card-primary">
                                    <div class="card-header" style="background-color:  {{config('app.color')}}">
                                        <h3 class="card-title">Edit Medicine</h3>
                                    </div>

                                    <div class="card-body">
                                        {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                        </p><br /> --}}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $pharmacy->name }}" autocomplete="off">
                                                    @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="code">Code</label>
                                                    <input class="form-control" name="code" value="{{ $pharmacy->code }}" autocomplete="off" />
                                            @error('code') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="expire_date">Expire Date</label>
                                            <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ $pharmacy->expire_date }}">
                                            @error('expire_date') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="10000" value="{{ $pharmacy->quantity }}" autocomplete="off">
                                            @error('quantity') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phoneNumber">Act Price</label>
                                            <input type="text" class="form-control" id="act_price" name="act_price" value="{{ $pharmacy->act_price }}" autocomplete="off">
                                            @error('act_price') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Sell price</label>
                                            <input class="form-control" id="sell_price" name="sell_price" value="{{ $pharmacy->sell_price }}" autocomplete="off"/>
                                            @error('sell_price') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Margin</label>
                                            <input class="form-control" id="margin" name="margin" value="{{ $pharmacy->margin }}" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Unit</label>
                                            <input class="form-control" name="unit" value="{{ $pharmacy->unit }}" autocomplete="off"/>
                                            @error('unit') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Vendor</label>
                                            <input class="form-control" rows="4" name="vendor" value="{{ $pharmacy->vendor }}" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Vendor Phone-Number</label>
                                            <input class="form-control" rows="4" name="vendor_phoneNumber" value="{{ $pharmacy->vendor_phoneNumber }}" autocomplete="off">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Description</label>
                                            <textarea class="form-control" rows="4" name="description" autocomplete="off">{{ $pharmacy->description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Storage Place</label>
                                            <input class="form-control" rows="4" name="storage_place" value="{{ $pharmacy->storage_place }}" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="gender">Status</label>
                                            @if($pharmacy->status == 1)
                                            <?php
                                            $m_checked = 'checked';
                                            $f_checked = '';
                                            ?>
                                            @else
                                            <?php
                                            $m_checked = '';
                                            $f_checked = 'checked';
                                            ?>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" <?php echo $m_checked; ?>>
                                                        <label class="form-check-label" for="active">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" <?php echo $f_checked; ?>>
                                                        <label class="form-check-label" for="inactive">
                                                            Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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

@endsection