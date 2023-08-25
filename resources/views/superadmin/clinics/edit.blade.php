@extends('layouts.super_layout')

@section('content')

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('superadmin.clinicUpdate', $clinic->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-body p-4">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value=" {{ $clinic->name }}">

                                @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Code" value="{{ $clinic->code }}">

                                @error('code')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" placeholder="09xxxxxxxxx" value={{ $clinic->phoneNumber }}>

                                @error('phoneNumber')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" placeholder="Address" name="address">{{ $clinic->address }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="expire_at">Expire Date</label>
                                <input type="date" class="form-control @error('expire_at') is-invalid @enderror" name="expire_at" value="{{ $clinic->expireDate->expire_at }}">

                                @error('expire_at')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-center p-3">
                            <button type="submit" class="btn" id="updateBtn" style="color: {{config('app.secondary_color')}};background-color: {{config('app.color')}}">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection