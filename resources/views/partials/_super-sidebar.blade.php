<style>
    .nav a:hover {
        opacity: 0.8;
    }
</style>

<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: {{config('app.color')}};">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="text-center mb-3">
            <a href="{{route('superadmin.index')}}">
                <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="img-fluid" width="30">
            </a>
            <h5 class="mt-3 fw-semibold d-none d-md-block">AungMyin</h5>
        </div>
        <div class="text-center mb-4">
            @if(Auth::user()->avatar)
            <img src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Avatar" class="rounded-circle" width="40" height="40">
            @else
            <img src="{{ asset('images/web-photos/no-image.jpg') }}" alt="Avatar" class="rounded-circle" width="40" height="40">
            @endif
            <span class=" d-none d-md-inline mx-1">{{ Auth::user()->name }}</span>
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="{{ route('superadmin.index') }}" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-house"></i>
                    <span class="ms-1 d-none d-md-inline">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.users') }}" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-people-fill fs-4"></i>
                    <span class="ms-1 d-none d-md-inline">Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.clinics') }}" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-house-heart-fill fs-4"></i>
                    <span class="ms-1 d-none d-md-inline">Clinics</span>
                </a>
            </li>
            <li>
                <a href="{{ route('package.index') }}" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-box-fill fs-4"></i>
                    <span class="ms-1 d-none d-md-inline">Packages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.feedback') }}" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-chat-dots-fill fs-4"></i>
                    <span class="ms-1 d-none d-md-inline">Feedback</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.profile') }}" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-gear-fill fs-4"></i>
                    <span class="ms-1 d-none d-md-inline">Setting</span>
                </a>
            </li>
        </ul>
        <hr>
        <div class="pb-3">
            <form action="{{ route('superadmin.logout') }}" method="post">
                @csrf
                <button class="btn btn-default text-white">
                    <i class="bi bi-box-arrow-right fs-3"></i>
                </button>
            </form>
        </div>
    </div>
</div>