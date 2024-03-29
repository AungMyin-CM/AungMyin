<style>
    .logout:hover {
        opacity: 0.7;
    }
</style>

@if ( Auth::guard('user')->user())
<aside class="main-sidebar sidebar-collapse sidebar-no-expand sidebar-light-primary elevation-4" style="background-color:#F5F5F5;">
    <!-- Brand Logo -->
    <a href="{{ route('user.home') }}" class="brand-link" style="background-color: {{config('app.color')}}">
        <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="brand-image">
        <span class="brand-text font-weight-white text-white">AungMyin</span>
    </a>

    <div class="sidebar" style="position: relative; min-height: 100%;">
        @php
            $loggedInUser = Auth::guard('user')->user();

            if ($loggedInUser) {
                $userClinic = $loggedInUser->user_clinic;

                $clinicLogo = '';

                if ($userClinic) {
                    $clinic = App\Models\Clinic::where('id',$userClinic->clinic)->get()->first();

                    if ($clinic) {
                        $clinicLogo = $clinic->avatar;
                    }
                }
            }
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if(Request::is('clinic-system/*'))
            <div class="image" id="clinic-logo-container">
                @if($clinicLogo != null)
                <img src="{{ asset('images/clinic-logos/'.$clinicLogo) }}" class="img-responsive avatar" alt="Clinic Logo" id="clinic-logo">
                @else
                <img src="{{ asset('images/web-photos/sidebar-clinic-logo.png') }}" class="img-circle elevation-2" alt="Clinic Image" id="clinic-logo" />
                @endif
            </div>

            <div class="info">
                <select class="form-control" name="u_clinics" id="u_clinics">
                    <option disabled>-- Select clinic --</option>
                    @if(isset($user_clinics))
                    @foreach($user_clinics as $u_c)
                    {{-- <option value="{{Crypt::encrypt($u_c[0]['id'])}}" {{$u_c[0]['id'] == session()->get('cc_id') ? 'selected' : '' }} >{{ Str::title($u_c[0]['name']) }} --}}
                    <option value="{{route('user.clinic',Crypt::encrypt($u_c[0]['id']))}}" name={{$u_c[0]['id'] }}>
                        {{ Str::title($u_c[0]['name']) }}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>
            @else

            <div class="image">
                @if(Auth::guard('user')->user()['avatar'] != null)
                <img src="{{asset('images/avatars/'.Auth::guard('user')->user()['avatar'])}}" class="img-responsive" alt="User Image">
                @else
                <img src="{{ asset('images/web-photos/no-image.jpg') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Str::title(Auth::guard('user')->user()['name']) }}</a>
            </div>
            @endif

        </div>
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/web-photos/sidebar-clinic-logo.png') }}" class="brand-image"/>
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
    </div> --}}

    @auth <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                @if (Auth::guard('user')->user())
                @if(Request::is('clinic-system/*'))

                <a href="{{ route('user.clinic', Crypt::encrypt(session()->get('cc_id'))) }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
                @else
                <a href="{{ route('user.home') }}" class="nav-link" title="Home">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
                @endif
                @endif
            </li>


            @if(Request::is('clinic-system/*'))

            @if (Auth::guard('user')->user())
            @if(Helper::checkPermission('user_view', $permissions))

            <li class="nav-item">
                <a href="{{ route('user.list') }}" class="nav-link" title="Users">
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
                <a href="{{ route('patient.index') }}" class="nav-link" title="Patients">
                    <i class="nav-icon fas fa-user-md"></i>
                    <p>
                        Patients
                    </p>
                </a>

            </li>
            @endif
            @endif

            @php
            $isInTreatment = Str::is('clinic-system/patient/*/treatment', request()->path());
            @endphp

            @if (Auth::guard('user')->user())
            @if(Helper::checkPermission('d_view', $permissions))

            <li class="nav-item">
                <a href="{{ route('dictionary.index') }}" class="nav-link" title="Shorthand">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Shorthand
                    </p>
                </a>
            </li>
            @endif
            @endif

            @if (Auth::guard('user')->user())
            @if(Helper::checkPermission('ph_view', $permissions))

            <li class="nav-item">
                <a href="{{ route('pharmacy.index') }}" class="nav-link" title="Pharmacy">
                    <i class="nav-icon fas fa-pills"></i>
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
                <a href="{{ route('pos.index') }}" class="nav-link" title="POS">
                    <i class="nav-icon fas fa-desktop"></i>
                    <p>
                        POS
                    </p>
                </a>

            </li>
            @endif
            @endif

            @if (Auth::guard('user')->user()->isAdmin())
            <li class="nav-item">
                <a href="{{ route('procedure.index') }}" class="nav-link" title="Procedure / Lab">
                    <i class="nav-icon fas fa-procedures"></i>
                    <p>
                        Procedure / Lab
                    </p>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('clinic.settings',Crypt::encrypt(Auth::guard('user')->user()->id)) }}" class="nav-link" title="Settings">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Settings
                    </p>
                </a>
            </li>

            {{-- <li class="nav-item">
                            <a class="nav-link" href="/home" type="submit" style=""><i
                                    class="nav-icon fas fa-sign-out-alt"></i><p> Switch Other Clinic</p></a>
                        </li>  --}}
            @endif
            {{-- <li class="nav-item">
                        @if (Auth::guard('user')->user())
                            <form action="{{ route('user.logout') }}" method="post">
            @endif
            @csrf
            <button class="nav-link" type="submit" style="">
                <i class="nav-icon fas fa-sign-out-alt text-red"></i>
                <p>
                    Logout
                </p>
            </button>
            </form>
            </li> --}}
        </ul>

        <hr>
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="position: absolute; bottom: 0; margin-bottom: 60px;">
            @if(isset($counts) && $counts > 0)
                <li class="nav-item">
                    <a class="nav-link" title="Feedback" id="feedbackBtn">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Feedback
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('docs.index') }}" class="nav-link" title="Help" target="_blank">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Help
                        </p>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-2 logout" style="margin-left: 17px;">
                @if (Auth::guard('user')->user())
                <form action="{{ route('user.logout') }}" method="post">
                    @endif
                    @csrf
                    <button class="nav-link text-dark" type="submit" style="display: contents;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    </div>
</aside>
@endauth
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    $(document).ready(function() {
        var someSession = {{ Session::get('cc_id') }};

        $('select option[name=' + someSession + ']').attr('selected', true);
        $("#u_clinics").change(function() {
            var $option = $(this).find(':selected');
            var url = $option.val();
            if (url != "") {
                window.location.href = url;
            }
        });
    });
</script>
@endif