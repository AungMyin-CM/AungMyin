<audio id="myaudio" src="{{asset('audio/noti.wav')}}"></audio>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script><!-- AdminLTE App -->
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{ asset('js/adminlte.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">

  $('#datatable').DataTable({
          columnDefs: [
              {
                  targets: [0],
                  orderData: [0, 1],
              },
              {
                  targets: [1],
                  orderData: [1, 0],
              },
              {
                  targets: [4],
                  orderData: [4, 0],
              },
          ],
      });
    
    function readAction(action){
      var id = action.getAttribute('data-id');

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                
        $.ajax({
            type: "POST",
            url: '/clinic-system/change-status',
            data: { is_read: '1' , id: id }
        }).done(function( response ) {
            if(response == 'changed')
            {
              window.location = '{{route('user.clinic', Crypt::encrypt(session()->get('cc_id')))}}'
            }else{
                alert("Something Went Wrong");
            }
        });

    }

    $(document).ready(function(){

            $('body').addClass('sidebar-collapse');

            $.ajax({
            type: "GET",
            url: '/clinic-system/check-noti',
              beforeSend: function(){
                $('.wrapper').css('opacity','0.1');
                $('.middle').css('opacity','1');
              },
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
                              '<a class="dropdown-item" onclick="readAction(this)" id="patient_noti'+data.id+'" data-id="'+data.id+'"><div class="media"><div class="media-body"><h3 class="dropdown-item-title">'+data.name+'</h3><ul class="list-unstyled"><li><small class="text-muted" id="age">Age: '+data.age+'</small></li><li><small class="text-muted" id="gender">Gender: '+(data.gender == 1 ? 'Male' : 'Female')+'</small></li></ul><p class="text-sm text-muted text-right"><i class="far fa-clock mr-1" id="time_'+data.id+'">  '+data.time+'</i></p></div></div></a><div class="dropdown-divider"></div>'
                            );                       
                          }
                          
                      });

                  }else{
                      $("#p_notis").append('<a href="#" id="no_noti" class="dropdown-item dropdown-footer">No notifications yet.</a>');
                  }
                }else if(response == 'no-session') {
                  console.log("Session expired");
                  $("#p_notis").append('<a href="#" id="no_noti" class="dropdown-item dropdown-footer">No notifications yet.</a>');

                }else{
                  $("#p_notis").append('<a href="#" id="no_noti" class="dropdown-item dropdown-footer">No notifications yet.</a>');

                }
                $('.wrapper').css('opacity','1');
                $('.middle').css('opacity','0.1');

              },
              error: function(httpObj, textStatus) {       
                        console.log(textStatus);              
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

        $('form').on('submit',function(){
          $('.wrapper').css('opacity','0.1');
          $('.middle').css('opacity','1');
        });

      
        $("#u_clinics").change(function(){
            var id = this.value;
            
            $.ajax({
                type: "GET",
                url: '/clinic-system/'+id,
                data: {code :id},
            }).done(function( response ) {
                window.location = '/clinic-system/'+id;
            });
        })
})
</script>
