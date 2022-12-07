@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: {{config('app.bg_color')}}">
    <div class="wrapper" id="mydiv">
        <div class="content-wrapper"  style="background-color: {{config('app.bg_color')}} !important">
            <section class="content">
                <div class="container-fluid">
                    <a href="#" class="btn btn-sm btn-tool mt-1 float-right" title="play" id="myModalBtn"  onclick="openVideo()" >
                        <i class="fas fa-play fa-lg" style="color:{{config('app.color')}}"></i>
                        <p style="color:{{config('app.color')}}">How to?</p>
                    </a>
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <iframe width="420" height="315" src="https://www.youtube.com/embed/cw21m2S5PXQ" frameborder="0" allowfullscreen autoplay></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 center-screen">
                        
                            <h1>{{Str::title($data['name'].' Clinic')}}</h1><br>
                            <div class="input-group text-red">
                                <input type="search" id="main_search" class="form-control form-control-lg" placeholder="Type your keywords here">
                                <input type="hidden" id="clinic_code" value="{{ Auth::guard('user')->user()['id'] }}" >
                                <div class="input-group-append">
                                    <a class="btn btn-lg btn-default" href="#" id="addRoute"><i id="search" class="fa fa-search"></i></a>
                                </div>
                            </div>

                            @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                            <div id="patientList" class="search-get-results" style="display:none;">
                            </div>
                            {{ csrf_field() }}
                        </div>
                    </div>
                    @if($data['patientData'] != "" && count($data['patientData']) != 0)
                    <div class="card">
                        <div class="card-body">
                         
                            <table id="dat" class="table table-bordered table-striped">                                    
                              <thead>
                                <tr>
                                    <th>Name</th>
                                
                                    <th>Age</th>
                                    <th>Father's name</th>
                                    <th>Actions</th>
                                    {{-- <th></th>
                                    <th></th> --}}
                                    {{-- <th colspan="3" style="width:15%;">Actions</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['patientData'] as $row)
                                        <tr id="patient_row_{{$row->id}}">
                                            <?php
                                             //  $date = $row->updated_at->diffForHumans();
                                               echo "<td>".$row->name."<span class='text-muted small float-right'>". $row->updated_at."</span>&nbsp;&nbsp;&nbsp;";
                                            ?>
                                                @if($row->gender ==1)
                                                <i class="fas fa-male fa-lg" style="color:blue;"></i> 
                                            @else
                                                <i class="fas fa-female fa-lg" style="color:rgb(251, 123, 145);"></i>
                                            @endif
                                            </td>
                                            
                                            <td>{{ $row->age }}</td>
                                            <td>{{ $row->father_name }}</td>
                                            <td>
                                                <div class="card-tools">
                                                    @if($data['role'] == 1 || $data['role'] == 2 || $data['role'] == 5)

                                                    <a href="{{ route('patient.edit' , Crypt::encrypt($row->id)) }}" class="btn btn-sm btn-tool">
                                                        <i class="fas fa-edit fa-lg" style="color:black;"></i>
                                                    </a>

                                                @endif
                                                @if($data['role'] == 2 || $data['role'] == 5)

                                                @if($data['a_doctors'] > 1)
                                                    <a href="#" class="btn btn-sm btn-tool" onclick="assignTo(this)" id="status" data-status="2" data-patient-id = "{{ $row->id }}">
                                                        <i class="fas fa-stethoscope fa-lg" style="color:blue;"></i>
                                                    </a>
                                                    <div class="modal fade" id="myModal" role="dialog">
                                                        <div class="modal-dialog">
                                            
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p class="text-left">Doctors</p>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <table class="table table-bordered" id="data">
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>Speciality</td>
                                                                        <td>Action</td>
                                                                    </tr>
                                                                    <tr>
                                                                       
                                                                    </tr>
                                                               </table>
                                                            </div>
                                                           
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-tool" onclick="updateStatus(this)" id="status" data-status="2" data-patient-id = "{{ $row->id }}">
                                                        <i class="fas fa-stethoscope fa-lg" style="color:blue;"></i>
                                                    </a>
                                                @endif

                                                @elseif($data['role'] == 1 || $data['role'] == 5)

                                                    <a href="{{ route('patient.treatment', Crypt::encrypt($row->id)) }}" style="margin:10px;"
                                                        ><i class="fas fa-stethoscope fa-lg"></i>
                                                    </a>

                                                @elseif($data['role'] == 3 || $data['role'] == 5)
                                                    <a href="{{ route('pos-patient', Crypt::encrypt($row->id)) }}" style="margin:10px ;"
                                                        ><i class="fas fa-receipt fa-lg"></i>
                                                    </a>
                        
                                                @endif
                                                    
                                                @if($data['role'] == 1 || $data['role'] == 2 || $data['role'] == 5)

                                                    <a href="#" class="btn btn-sm btn-tool" onclick="updateStatus(this)" id="status" data-status="5" data-patient-id = "{{ $row->id }}">
                                                        <i class="fas fa-trash fa-lg" style="color:rgb(239, 6, 6);"></i>
                                                    </a>

                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                          </div>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    $(document).ready(function(){
        
        $('#dat').DataTable({
            dom: 'Bfrtip',
            buttons: [],
            searching: false,
             paging: false,
             info: false
        });
        $(document).ready(function(){
   $('.middle').css('opacity','0');
     });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#main_search').keyup(function(){ 
                var query = $(this).val();
                
                var clinic_id = $("#clinic_code").val();
                $.ajax({
                    type: "POST",
                    url: '/clinic-system/search',
                    data: { key: query, clinic_id: clinic_id}
                }).done(function( response ) {
                   
                if(query != '')
                {
                    if(response == ''){
                        $("#search").removeAttr("class","fa fa-search");
                        $("#search").attr("class","fa fa-plus");
                        $("#addRoute").attr("href", "{{ route('patient.create') }}"+"?name="+query);
                    }else{
                        $("#search").removeAttr("class","fa fa-plus");
                        $("#search").attr("class","fa fa-search");
                        $("#addRoute").attr("href", "{{ route('patient.index') }}"+"?name="+query);
                    }
                    $('#patientList').css("display","block");  
                    $('#patientList').html(response);
                }
                else{
                    $('#patientList').css("display","none");  
                    $('#patientList').html("");
                }
            });
        });
    });
    function updateStatus(status){
        var p_status = status.getAttribute('data-status');
        var patient_id = status.getAttribute('data-patient-id');
        var receiver_id  = status.getAttribute('receiver-id');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                
        $.ajax({
            type: "POST",
            url: '/clinic-system/updateStatus',
            data: { status: p_status, patient_id: patient_id, receiver_id: receiver_id }
        }).done(function( response ) {
            alert(response);
            if(response == 'changed')
            {
                $("#patient_row_"+patient_id).remove();
               
            }else{
                alert("Something Went Wrong");
            }
            $('#myModal').modal('hide');
        });
    };

    function assignTo(data)
    {
        var patient_id = data.getAttribute('data-patient-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                
        $.ajax({
            type: "GET",
            url: '/clinic-system/getDoctors',
        }).done(function( response ) {
            $.each(response, function(i, data){
                var val = $('#d-id'+data.id).attr('receiver-id');
                if(val == undefined){
                    $("#data").append("<tr ><td>"+data.name+"</td><td>"+data.speciality+"</td><td><a href='#/"+data.id+"' class='btn btn-primary' id='d-id"+data.id+"' receiver-id='"+data.id+"' data-patient-id='"+patient_id+"' data-status='2' onclick='updateStatus(this)'>Assign</a></td></tr>");
                    $('#myModal').modal({
                        backdrop: 'static',
                    });
                }else if($('#d-id'+data.id).attr('receiver-id') != data.id){
                    $("#data").append("<tr><td>"+data.name+"</td><td>"+data.speciality+"</td><td><a href='#/"+data.id+"' class='btn btn-primary' id='d-id"+data.id+"' receiver-id='"+data.id+"' data-patient-id='"+patient_id+"' onclick='updateStatus(this)'>Assign</a></td></tr>");
                    $('#myModal').modal({
                        backdrop: 'static',
                    });                }
                    $('#myModal').modal({
                        backdrop: 'static',
                    });

            })
        });
    }
    function openVideo(){
        $('#myModal2').modal({
                        backdrop: 'static',
                    });    
    }
</script>
@endsection