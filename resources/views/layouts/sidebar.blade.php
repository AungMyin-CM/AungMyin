@if ( Auth::guard('user')->user())
    <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:#F5F5F5;">
        <!-- Brand Logo -->
        <a  href="{{ route('user.home') }}" class="brand-link" style="background-color: #0077B6">
            <img src="{{ asset('images/web-photos/aung-myin-logo.png') }}" alt="AdminLTE Logo" class="brand-image"  >
            <span class="brand-text font-weight-white text-white">AungMyin</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(Auth::guard('user')->user()['avatar'] != null)
                        <img src="{{asset('images/avatars/'.Auth::guard('user')->user()['avatar'])}}" class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744004?k=20&m=1016744004&s=612x612&w=0&h=Z4W8y-2T0W-mQM-Sxt41CGS16bByUo4efOIJuyNBHgI=" class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::guard('user')->user()['name'] }}</a>
                </div>

            </div>
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
                </div>
              </div> --}}

        @auth      <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                        <li class="nav-item">
                            @if (Auth::guard('user')->user())
                                @if(Request::is('clinic-system/*'))

                                    <a href="{{ route('user.clinic', Crypt::encrypt(session()->get('cc_id'))) }}" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                @else
                                <a href="{{ route('user.home') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                                @endif
                            @endif
                        </li>


                    @if(Request::is('clinic-system/*'))

                        @if (Auth::guard('user')->user())
                            @if(Helper::checkPermission('user_view', $permissions))

                                <li class="nav-item">
                                    <a href="{{ route('user.list') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if (Auth::guard('user')->user())
                            @if(Helper::checkPermission('p_view', $permissions))

                                <li class="nav-item">
                                    <a href="{{ route('patient.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-md"></i>
                                        <p>
                                            Patients
                                        </p>
                                    </a>

                                </li>
                            @endif
                        @endif
                        @if (Auth::guard('user')->user())
                            @if(Helper::checkPermission('d_view', $permissions))
                                <li class="nav-item">
                                    <a href="{{ route('dictionary.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Dictionary
                                        </p>
                                    </a>

                                </li>
                            @endif
                        @endif

                        @if (Auth::guard('user')->user())
                        @if(Helper::checkPermission('ph_view', $permissions))
                                <li class="nav-item">
                                    <a href="{{ route('pharmacy.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-medkit"></i>
                                        <p>
                                            Pharmacy
                                        </p>
                                    </a>

                                </li>
                            @endif
                        @endif

                        @if (Auth::guard('user')->user())
                            @if(Helper::checkPermission('pos_view', $permissions))
                                <li class="nav-item">
                                    <a href="{{ route('pos.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-desktop"></i>
                                        <p>
                                            POS
                                        </p>
                                    </a>

                                </li>
                            @endif
                        @endif

                        <hr size="30" style="border-top:1px solid red !important;">

                        <li class="nav-item">
                            <a href="{{ route('clinic.settings') }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Settings
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/home" type="submit" style=""><i
                                    class="nav-icon fas fa-sign-out-alt"></i><p> Switch Other Clinic</p></a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @if (Auth::guard('user')->user())
                            <form action="{{ route('user.logout') }}" method="post">
                        @endif
                        @csrf
                        <button class="nav-link" type="submit" style="">
                            <i class="nav-icon fas fa-sign-out-alt text-red"></i> 
                            Logout
                        </button>
                        </form>            
                    </li>   
                </ul>
            </nav>
        </div>
    </aside>
@endauth
@endif