<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aung Myin Clinic Manager</title>

    <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" type="image/x-icon"/>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/draggable.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}" />

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    
    <style>
       body{
          background-color: {{config('app.bg_color')}}
        }
    </style>


    <script src="{{asset('js/iziToast.min.js') }}"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
      
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
    
      var pusher = new Pusher('4477b1080cfccdc685cf', {
        cluster: 'ap1'
      });
      var clinicId ={{ Session::has('cc_id') ? Session::get('cc_id') : 0 }};
      var userId = "<?php echo  Auth::guard('user')->user() ? Auth::guard('user')->user()['id'] : '0' ?>";
      var channel = pusher.subscribe('aungmyin_'+ clinicId + "_" + userId);
      channel.bind('notice', function(data) {
        var promise =   document.getElementById('myaudio').play();
        if (promise !== undefined) {
        promise.then(_ => {}).catch(error => {});}
        iziToast.show({
            position: 'topRight',
            titleColor: '#FFFFFF',
            messageColor: '#FFFFFF',
            timeout: 20000,
            backgroundColor: '#95bb72',        
            message: data.message
            });

            $.ajax({
            type: "GET",
            url: '/clinic-system/check-noti',
        
              success: function( response ) {
                if(response != 'no-data'){

                  var noti_number = Object.keys(response).length;
                  if(noti_number > 0 && response != 'no-session') {
                    $(".noti-number").text(Object.keys(response).length);
                      $.each(response, function(i, data){
                          if(document.getElementById('patient_noti'+data.id) != null){
                            $("[id='time_"+data.id+"']").text(' '+data.time);
                            $("[id='time_"+data.patient_id+"']").text(' '+data.time);
                          }else{
                            if(document.getElementById('no_noti') != null){
                                $("#no_noti").remove();
                            }
                            $("#p_notis").append(
                              '<a class="dropdown-item" onclick="readAction(this)" id="patient_noti'+data.id+'" data-id="'+data.id+'"><div class="media"><div class="media-body"><h3 class="dropdown-item-title">'+data.name+'</h3><ul class="list-unstyled"><li><small class="text-muted" id="age">Age: '+data.age+'</small></li><li><small class="text-muted" id="gender">Gender: '+(data.gender == 1 ? 'Male' : 'Female')+'</small></li></ul><p class="text-sm text-muted text-right"><i class="far fa-clock mr-1" id="time_'+data.id+'">'+data.time+'</i></p></div></div></a><div class="dropdown-divider"></div>'
                            );                       
                          }
                          
                      });


                    }else{
                       
                        $("#p_notis").append('<a href="#" id="no_noti" class="dropdown-item dropdown-footer">No notifications yet.</a>');
                    }
                }else if(response == 'no-session') {
                  console.log("Session expired");
                }else{

                }

              },
              error: function(httpObj, textStatus) {       
                    location.reload();
                },
            });

            if(document.getElementById('on_home_page'))
              {

                $.ajax({
                type: "GET",
                url: "{{route('wait.list')}}",
                data: {code: '{{ Crypt::encrypt(session()->get('cc_id')) }}'},

                beforeSend: function(){
                  $('.wrapper').css('opacity','0.1');
                  $('.middle').css('opacity','1');
                },

                success: function(response){
                  $("#waiting-list").empty();
                  $("#waiting-list").append(response);
                  $('.wrapper').css('opacity','1');
                  $('.middle').css('opacity','0.1');
                },
              });
            }
      });
    </script>
</head>
<body class="sidebar-mini layout-fixed sidebar-collapse" data-new-gr-c-s-check-loaded="14.1112.0" data-gr-ext-installed="" cz-shortcut-listen="true" style="height: auto;">
  
<div class="middle">
    <div class="bar bar1"></div>
    <div class="bar bar2"></div>
    <div class="bar bar3"></div>
    <div class="bar bar4"></div>
    <div class="bar bar5"></div>
    <div class="bar bar6"></div>
    <div class="bar bar7"></div>
    <div class="bar bar8"></div>
</div>

@include('layouts.navbar')

@include('layouts.sidebar')

@yield('content')

</body>


@if(Request::is('clinic-system/*') || Request::is('home') || Request::is('package-selection'))
@include('layouts.js')
@endif
