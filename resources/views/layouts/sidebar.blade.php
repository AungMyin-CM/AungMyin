@if (Auth::guard('clinic')->user() || Auth::guard('user')->user())
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">AungMyin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                    {{-- <p class="text-white">{{ Auth::guard('clinic')->user()['id'] }}</p> --}}
                </div>
                <div class="info">
                    {{-- <a href="#" class="d-block">{{  }}</a> --}}
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('clinic.home') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.list') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dictionary.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Dictionary
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('patient.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-patient"></i>
                            <p>
                                Patients
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        @if (Auth::guard('clinic')->user())
                            <form action="{{ route('clinic.logout') }}" method="post">
                            @elseif(Auth::guard('user')->user())
                                <form action="{{ route('user.logout') }}" method="post">
                        @endif
                        @csrf

                        <button class="nav-link" type="submit" style=""><i
                                class="nav-icon fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                        {{-- @if (Auth::guard('clinic')->user())
              <a href="{{ route('clinic.logout')}}" class="nav-link">
           @elseif(Auth::guard('user')->user())
              <a href="{{ route('user.logout')}}" class="nav-link">
            @endif --}}
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endif
