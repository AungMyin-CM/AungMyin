@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <h2 class="text-center display-4">Search</h2>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
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
                        @if($data != "")
                            <div class="col-md-4">                    
                                @foreach ($data as $row)
                                    <div>{{$row->name}}</div>
                                @endforeach
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
