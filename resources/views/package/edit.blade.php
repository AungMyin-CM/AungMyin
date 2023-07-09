@extends('layouts.super_layout')

@section('content')

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('package.update', $package->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $package->name }}">
                                    </div>
                                    @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $package->type }}">
                                    </div>
                                    @error('type')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $package->price }}">
                                    </div>
                                    @error('price')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="trialPeriod">Trial Period</label>
                                        <div class="d-flex gap-1">
                                            <div class="">
                                                <input type="number" class="form-control" name="trialPeriodNumber" value="{{ $number }}">
                                            </div>
                                            <div class="w-75">
                                                <select class="form-select" name="trialPeriodUnit" required>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category }}" {{$category === $unit ? "selected" : ""}}>{{ ucfirst($category) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check mb-3">
                                        <input type="hidden" name="isDiscount" value="0">
                                        <input class="form-check-input" type="checkbox" name="isDiscount" value="1" {{ $package->isDiscount ? 'checked' : '' }} onchange="handleDiscountDates(this)">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Is Discount
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="discountPercentage">Discount Percentage</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="discountPercentage" id="discountPercentage" value="{{ $package->discountPercentage }}" {{ $package->isDiscount ? '' : 'disabled' }}>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discountStartDate">Discount Start Date</label>
                                        <input type="date" class="form-control" name="discountStartDate" id="discountStartDate" value="{{ substr($package->discountStartDate, 0, 10) }}" {{ $package->isDiscount ? '' : 'disabled' }}>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discountEndDate">Discount End Date</label>
                                        <input type="date" class="form-control" name="discountEndDate" id="discountEndDate" value="{{ substr($package->discountEndDate, 0, 10) }}" {{ $package->isDiscount ? '' : 'disabled' }}>
                                    </div>
                                </div>
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

<script>
    function handleDiscountDates(checkbox) {
        let discountPercentage = document.getElementById('discountPercentage');
        let discountStartDate = document.getElementById('discountStartDate');
        let discountEndDate = document.getElementById('discountEndDate');

        if (checkbox.checked) {
            discountPercentage.disabled = false;
            discountStartDate.disabled = false;
            discountEndDate.disabled = false;
        } else {
            discountPercentage.disabled = true;
            discountPercentage.value = '';
            discountStartDate.disabled = true;
            discountStartDate.value = '';
            discountEndDate.disabled = true;
            discountEndDate.value = '';
        }

        checkbox.previousElementSibling.value = checkbox.checked ? '1' : '0';
    }
</script>

@endsection