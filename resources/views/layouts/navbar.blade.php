@if (Auth::guard('user')->user() || Auth::guard('user')->user())
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  

        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item" style="margin-top: 8px;"> Hello Dr. @if(Auth::guard('user')->user()){{ Auth::guard('user')->user()['name'] }} @endif
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item" style="margin-top: 8px; color:#0077B6">
                <span id="time"> 
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell noti-icon" id="noti-icon"></i>
                    <span class="badge badge-warning navbar-badge noti-number">{{count($notis)}}</span>
                    <span hidden id="noti">{{count($notis)}}</span>

                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="p_notis">
                    
                </div>
            </li>            
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                    role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
            <li class="nav-item"> 
                @if (Auth::guard('user')->user())
                    <form action="{{ route('user.logout') }}" method="post"  id="logout"> 
                @endif
                        @csrf
                        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                            role="button">
                            <i class="fas fa-sign-out-alt" title="Logout" id="logout_btn"></i>
                        </a>
                    </form>  
            </li>
        </ul>
    </nav>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        var datetime = new Date();
        var day = datetime.toLocaleDateString('default', { weekday: 'long' });      
        var date = datetime.getDate();
        var month = datetime.toLocaleString('default', { month: 'long' });
        var year = datetime.getFullYear();
        document.getElementById("time").textContent = date+" " + month +" " + year +", " + day;

        $('#logout_btn').click(function(){ 
   $('#logout').submit();
});

        </script>
@endif
