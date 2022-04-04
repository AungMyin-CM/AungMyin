@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if($data != "" && count($data) != 0)
                            <div class="col-md-8 p-2">
                        @else
                            <div class="col-md-8 offset-md-2 p-2">
                        @endif

                            <div class="input-group">
                                <input type="search" id="main_search" class="form-control form-control-lg" placeholder="Type your keywords here">
                                <input type="hidden" id="clinic_code" value="{{ Auth::guard('user')->user()['clinic_id'] }}" >
                                <div class="input-group-append">
                                    <a class="btn btn-lg btn-default" href="#" id="addRoute"><i id="search" class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div id="patientList" style="display:none;">
                            </div>
                            {{ csrf_field() }}
                        </div>
                        @if($data != "" && count($data) != 0)
                            <div class="col-md-4 p-2">                    
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Waiting List</h3>
                                    </div>
                                    <div class="card-body"> 
                                        @foreach ($data as $row)
                                            <div class="card" style="background:#FFFFFF;">
                                                <div class="card-header border-0">
                                                    <h3 class="card-title bold">{{ $row->name }}&nbsp;&nbsp;&nbsp;
                                                        @if($row->gender ==1)
                                                       <i class="fas fa-male fa-lg" style="color:blue;"></i> 
                                                       @else
                                                        <i class="fas fa-female fa-lg" style="color:rgb(251, 123, 145);"></i>
                                                        @endif
                                                    </h3>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-sm btn-tool">
                                                            <i class="fas fa-edit fa-lg" style="color:black;"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-tool">
                                                            <i class="fas fa-stethoscope fa-lg" style="color:blue;"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-tool">
                                                            <i class="fas fa-trash fa-lg" style="color:rgb(239, 6, 6);"></i>
                                                        </a>
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
                                                        <small>{{ $row->updated_at }}</small>
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
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>

    $(document).ready(function(){

        $('#main_search').keyup(function(){ 
                var query = $(this).val();
                
                var clinic_id = $("#clinic_code").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: '/search',
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

        // $(document).on('click', 'li', function(){  
        //     $('#country_name').val($(this).text());  
        //     $('#countryList').fadeOut();  
        // });  

        });
</script>
@endsection
