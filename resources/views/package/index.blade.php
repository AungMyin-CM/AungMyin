@extends('layouts.super_layout')

@section('content')
<style>
    .pagination .active .page-link {
        background-color: #003049;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('partials._super-sidebar')

            <div class="col py-3">
                <div class="container-fluid">
                    @if (Session::has('success'))
                    @include('partials._toast')
                    @endif
                    <a href="{{ route('package.create') }}" class="btn text-white float-end mb-3" style="background-color: {{config('app.color')}};">
                        <i class="bi bi-plus-lg"></i> Add New
                    </a>

                    <table id="userTable" class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Trial Period (Days)</th>
                                <th>Is Discount</th>
                                <th>Discount Percentage</th>
                                <th>Discount Start Date</th>
                                <th>Discount End Date</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->type }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->trialPeriod }}</td>
                                <td>{{ $package->isDiscount === 0 ? 'no' : 'yes' }}</td>
                                <td>{{ $package->discountPercentage }}</td>
                                <td>{{ substr($package->discountStartDate, 0, 10) }}</td>
                                <td>{{ substr($package->discountEndDate, 0, 10) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 10px">
                                        <div>
                                            <a href="{{route('package.edit', $package->id)}}" class="btn btn-default">
                                                <i class="bi bi-pencil-square fs-4" style=" color: {{config('app.color')}}"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{route('package.destroy', $package->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-default">
                                                    <i class="bi bi-trash fs-4" style="color:#E95A4A;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    let table = new DataTable("#userTable", {
        "paging": true,
        "info": true,
        search: {
            caseInsensitive: true
        },
        language: {
            searchPlaceholder: "Search users...",
            search: "",
        },
    });
</script>

@endsection