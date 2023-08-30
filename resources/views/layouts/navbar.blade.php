<style>
    .search-box {
        display: none;
    }

    .search {
        width: 400px;
        font-size: 18px;
        letter-spacing: 1px;
        border-radius: 15px !important;
        padding: 20px 15px;
    }

    .search::placeholder {
        font-size: 16px;
    }

    .search:focus {
        border: 2px solid #003049;
    }

    @media (max-width: 768px) {
        #date-time {
            display: none;
        }

        .search {
            width: 100%;
        }
    }
</style>

@if (Auth::guard('user')->user() || Auth::guard('user')->user())
<nav class="main-header navbar navbar-expand navbar-white navbar-light">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav">
        @if(Request::is('clinic-system/*') && \Route::currentRouteName() !== 'user.clinic')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('user.clinic', Crypt::encrypt(session() -> get('cc_id'))) }}">Home</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>

        @if(\Route::currentRouteName() === 'user.list')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">User</a>
        </li>

        @elseif(\Route::currentRouteName() === 'user.create')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('user.list') }}">User</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Create</a>
        </li>

        @elseif(\Route::currentRouteName() === 'user.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('user.list') }}">User</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'patient.index')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Patient</a>
        </li>

        @elseif(\Route::currentRouteName() === 'patient.create')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('patient.index') }}">Patient</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Create</a>
        </li>

        @elseif(\Route::currentRouteName() === 'patient.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('patient.index') }}">Patient</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'patient.treatment')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('patient.index') }}">Patient</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Treatment</a>
        </li>

        @elseif(\Route::currentRouteName() === 'dictionary.index')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Shorthand</a>
        </li>

        @elseif(\Route::currentRouteName() === 'dictionary.create')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('dictionary.index') }}">Shorthand</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Create</a>
        </li>

        @elseif(\Route::currentRouteName() === 'dictionary.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('dictionary.index') }}">Shorthand</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pharmacy.index')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Pharmacy</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pharmacy.create')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('pharmacy.index') }}">Pharmacy</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Create</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pharmacy.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('pharmacy.index') }}">Pharmacy</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pos.index')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">POS</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pos.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('pos.index') }}">POS</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'pos.history')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('pos.index') }}">POS</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">History</a>
        </li>

        @elseif(\Route::currentRouteName() === 'procedure.index')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Procedure-Lab</a>
        </li>

        @elseif(\Route::currentRouteName() === 'procedure.create')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('procedure.index') }}">Procedure-Lab</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Create</a>
        </li>

        @elseif(\Route::currentRouteName() === 'procedure.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('procedure.index') }}">Procedure-Lab</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'investigation.edit')
        <li class="nav-item d-none d-md-inline">
            <a class="small" href="{{ route('procedure.index') }}">Procedure-Lab</a>
            &nbsp;
            <i class="fas fa-arrow-right fa-xs"></i>
            &nbsp;
        </li>
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Edit</a>
        </li>

        @elseif(\Route::currentRouteName() === 'clinic.settings')
        <li class="nav-item d-none d-md-inline">
            <a class="text-dark small" role="link" aria-disabled="true">Update</a>
        </li>

        @endif
        @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item row" id="date-time" style="margin-top: 8px; color:#0077B6">
            <span id="time"></span>&nbsp;
            <span class="clock">
                <span class="display"></span>
            </span>
        </li>

        @if(Request::is('clinic-system/*') && \Route::currentRouteName() != 'user.home' && \Route::currentRouteName() != 'user.clinic' && \Route::currentRouteName() != 'pos.index')

        <li class="nav-item" style="margin-top: 8px;">
            <div id="search-box" class="search-box">
                <input type="text" class="form-control rounded search" id="input-search" placeholder="Type to Search..." autocomplete="off">
                <div id="patientList" class="search-get-results" style="display:none;">
                </div>

                <div id="loading-indicator" class="text-center mt-2" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
            </div>
        </li>
        @endif
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if(Request::is('clinic-system/*') && \Route::currentRouteName() != 'user.home' && \Route::currentRouteName() != 'user.clinic' && \Route::currentRouteName() != 'pos.index')

        <li class="nav-item" style="margin-top: 8px;">
            <button class="nav-link" style="display: contents;" id="search-btn">
                <i class="fas fa-search fa-lg"></i>
            </button>
        </li>
        @endif

        @if(Request::is('clinic-system/*'))
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell noti-icon" id="noti-icon"></i>
                <span class="badge badge-warning navbar-badge noti-number">{{isset($notis) ? count($notis) : '0'}}</span>
                <span hidden id="noti">{{isset($notis) ? count($notis) : '0'}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="p_notis">

            </div>
        </li>
        @endif
        <li class="nav-item d-none d-md-block">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    var datetime = new Date();
    var day = datetime.toLocaleDateString('default', {
        weekday: 'long'
    });
    var date = datetime.getDate();
    var month = datetime.toLocaleString('default', {
        month: 'long'
    });
    var year = datetime.getFullYear();
    document.getElementById("time").textContent = date + " " + month + " " + year + ", " + day;

    setInterval(function() {
        const clock = document.querySelector(".display");
        let time = new Date();
        let sec = time.getSeconds();
        let min = time.getMinutes();
        let hr = time.getHours();
        let day = 'AM';
        if (hr > 12) {
            day = 'PM';
            hr = hr - 12;
        }
        if (hr == 0) {
            hr = 12;
        }
        if (sec < 10) {
            sec = '0' + sec;
        }
        if (min < 10) {
            min = '0' + min;
        }
        if (hr < 10) {
            hr = '0' + hr;
        }
        clock.textContent = hr + ':' + min + ':' + sec + " " + day;
    });

    $(document).ready(function() {
        $("#search-btn").click(function() {
            $("#date-time").hide();
            $("#search-box").show();
        });

        $(document).click(function(event) {
            if (!$(event.target).closest("#search-box").length && !$(event.target).closest("#search-btn").length) {
                $("#search-box").hide();
                if ($(window).width() >= 768) {
                    $("#date-time").show();
                }
            }
        });
    });
</script>
@endif