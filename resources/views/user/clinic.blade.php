@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                            {{-- @if($data['patientData'] != "" && count($data['patientData']) != 0)
                                <div class="col-md-8 p-2">
                            @else
                                <div class="col-md-8 offset-md-2 p-2">
                            @endif --}}
                            <div class="col-md-8 center-screen">

                                <h1>{{Str::title('Welcome To '.$data['name'])}}</h1><br>

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
                        @if($data['patientData'] != "" && count($data['patientData']) != 0)
                            <div class="col-md-4 p-2">                    
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Waiting List</h3>
                                    </div>
                                    <div class="card-body"> 
                                        @foreach ($data['patientData'] as $row)
                                            <div class="card" id="card_waiting{{$row->id}}" style="background:#FFFFFF;">
                                                <div class="card-header border-0">
                                                    <h3 class="card-title bold">{{ $row->name }}&nbsp;&nbsp;&nbsp;
                                                        @if($row->gender ==1)
                                                            <i class="fas fa-male fa-lg" style="color:blue;"></i> 
                                                       @else
                                                            <i class="fas fa-female fa-lg" style="color:rgb(251, 123, 145);"></i>
                                                        @endif
                                                    </h3>
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

                                                    </div><br/>
                                                    <div class="float-left">
                                                        <div class="col-md-12">
                                                            Age: {{ $row->age }}  
                                                        </div>
                                                        <div class="col-md-12">
                                                            Father's Name: {{ $row->father_name }}   
                                                        </div>  
                                                        
                                                    </div>
                                                    <div class="float-right">
                                                        <br/>
                                                        <small id="time_{{$row->id}}">{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</small>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div class="float-right" style="position: absolute;right:0;bottom:0;">
                    <a href="{{ route('feedback.create') }}" class="btn btn-primary float-right">Feedback <i class="fas fa-comments"></i></a>
                </div> --}}
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    $(document).ready(function(){
        
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
            if(response == 'changed')
            {
                $("#card_waiting"+patient_id).slideUp();
                $('#myModal').modal('hide');
            }else{
                alert("Something Went Wrong");
            }
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
</script>
@endsection