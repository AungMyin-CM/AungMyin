@extends('layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">Search</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="simple-results.html">
                        <div class="input-group">
                            <input type="search" id="main_search" class="form-control form-control-lg" placeholder="Type your keywords here">
                            <input type="hidden" id="clinic_code" value="{{ Auth::guard('user')->user()['clinic_id'] }}" >

                            <div id="patientList" class="input-group">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        {{ csrf_field() }}

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>

    $(document).ready(function(){

        $('#main_search').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
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
                    $('#patientList').fadeIn();  
                    $('#patientList').html(response);
                });
            }
        });

        // $(document).on('click', 'li', function(){  
        //     $('#country_name').val($(this).text());  
        //     $('#countryList').fadeOut();  
        // });  

        });
</script>
@endsection
