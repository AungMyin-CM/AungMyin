@extends('layouts.super_layout')

@section('content')

<div class="container-fluid">
    <div class="row flex-nowrap">
        @include('partials._super-sidebar')

        <div class="col py-5">
            <div class="container mt-5 d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 18rem; height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-center">Users</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="text-muted">Total Users:</span>
                                        {{ $total_users }}
                                    </li>
                                    <li class="list-group-item">
                                        <span class="text-muted">Package Purchased Users:</span>
                                        {{ $p_users }}
                                    </li>
                                    <li class="list-group-item">
                                        <span class="text-muted">Free Users:</span>

                                    </li>
                                    <li class="list-group-item">
                                        <span class="text-muted">Only Verified:</span>
                                        {{ $v_users }}
                                    </li>
                                    <li class="list-group-item">
                                        <span class="text-muted">Unverified Users:</span>
                                        {{ $u_users }}
                                    </li>
                                    <li class="list-group-item">
                                        <span class="text-muted">Clinic Users:</span>
                                        {{ $c_users }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 18rem; height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-center">Clinics</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="text-muted">Total Clinics:</span>
                                        {{ $total_clinics }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 18rem; height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-center">Packages</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="text-muted">Total Packages:</span>
                                        {{ $total_packages }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection