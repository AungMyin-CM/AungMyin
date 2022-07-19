@if ( Auth::guard('user')->user())
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="https://cdn.vox-cdn.com/thumbor/Pkmq1nm3skO0-j693JTMd7RL0Zk=/0x0:2012x1341/1200x800/filters:focal(0x0:2012x1341)/cdn.vox-cdn.com/uploads/chorus_image/image/47070706/google2.0.0.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AungMyin</span>
        </a>

      
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image text-center">
                    <p class="text-white">
                        @if(Auth::guard('user')->user())
                             {{ Auth::guard('user')->user()['name'] }}<br>
                        @endif
                       
                    </p>

                </div>
                <div class="info">
                    {{-- <a href="#" class="d-block">{{  }}</a> --}}
                </div>
            </div>

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
                            <li class="nav-item">
                                <a href="{{ route('user.list') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>

                            </li>
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

                        <li class="nav-item">
                        

                            <a class="nav-link" href="/home" type="submit" style=""><i
                                    class="nav-icon fas fa-sign-out-alt"></i> Switch Other Clinic</a>
                      
                        </li>
                    @endif
                    <li class="nav-item">
                        @if (Auth::guard('user')->user())
                            <form action="{{ route('user.logout') }}" method="post">
                        @endif
                        @csrf

                        <button class="nav-link" type="submit" style=""><i
                                class="nav-icon fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                       
                    </li>

                   
                </ul>
            </nav>
        </div>
    </aside>
@endauth
@endif