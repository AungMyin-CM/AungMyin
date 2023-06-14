@extends('layouts.super_layout')

@section('content')

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: {{config('app.color')}};">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <div class="text-center mb-3">
                    <a href="{{route('superadmin.index')}}">
                        <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="img-fluid" width="30">
                    </a>
                    <h5 class="mt-3 fw-semibold d-none d-md-block">AungMyin</h5>
                </div>
                <div class="text-center mb-4">
                    <img src="{{ asset('images/web-photos/no-image.jpg') }}" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-md-inline mx-1">{{ Auth::user()->name }}</span>
                </div>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="{{ route('superadmin.index') }}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i>
                            <span class="ms-1 d-none d-md-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="bi bi-people-fill fs-4"></i>
                            <span class="ms-1 d-none d-md-inline">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="bi bi-house-heart-fill fs-4"></i>
                            <span class="ms-1 d-none d-md-inline">Clinics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="bi bi-box-fill fs-4"></i>
                            <span class="ms-1 d-none d-md-inline">Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="bi bi-gear-fill fs-4"></i>
                            <span class="ms-1 d-none d-md-inline">Setting</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="pb-3">
                    <form action="{{ route('superadmin.logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span class="ms-1 d-none d-md-inline">Log out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

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