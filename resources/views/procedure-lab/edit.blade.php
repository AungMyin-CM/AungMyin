@extends("layouts.app")

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
                <section class="content-header">
                  
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: {{config('app.color')}}">
                                        <h3 class="card-title">Please fill out form</h3>
                                    </div>
                                   
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ route('procedure.update',Crypt::encrypt($procedure->id)) }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" id="type" name="name" required placeholder="Eg: ..." value="{{old("name")}}" >
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert" id="alert-message">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror --}}
                                                            <input type="input" disabled value={{$type}} class="form-control"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="code">Code</label>

                                                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{$procedure->code}}" required placeholder="Eg: ..." value="{{old("code")}}" >
                                                        @error('code')
                                                            <span class="invalid-feedback" role="alert" id="alert-message">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="code">Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required placeholder="Eg: ..." value="{{old("name")}}" >
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert" id="alert-message">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id= "dictonary_div">
                                                        <label for="meaing">Price</label>
                                                        <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="price" name="meaning" rows="7" value="{{old('price')}}" onkeypress="return isNumber(event)">
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert" id="alert-message">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}

                                                <span id="med_data" hidden>{{$procedure->name}}</span>
                                                <span id="med_data_1" hidden>{{$procedure->price}}</span>

                                                <div id="med_div">
                                                    <section class="content">
                                                        <div class="container-fluid" id="medtable">
                                                            
                                                    </section>
                                                </div>  
                                                   
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <input type="submit" class="btn btn-primary" value="Submit" style="background-color: {{config('app.color')}}">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            var med_data = $("#med_data").text().toString();
            var med_data_1 = $("#med_data_1").text().toString();

            const res = med_data.split("^");
            const price = med_data_1.split("^");

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var fil_res = cleanArray(res);
            var fil_price = cleanArray(price);

            var table_str = '<table class="table table-bordered" id="lab_table">'+ 
                            '<th style="width:40%">Name</th>'+                                              
                            '<th>Price</th>'+
                            '<th ><button type="button" id="add_lab_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>';
                
                for (i =0; i < fil_res.length; i++){

                    table_str +=
                    '<tr id="row_'+i+'">'+
                        '<td><input type="text" name="name[]" id="product_search_1" onkeyup="searchMed(1)" class="form-control" value="'+fil_res[i]+'" readonly /> </td>'+
                        '<td><input type="text"   name="price[]"  class="form-control" value="'+fil_price[i]+'"/></td>'+
                        '<td><button type="button" class="btn btn-default" id="remove_row_'+i+'"><i class="fa fa-minus"></i></button></td>'+

                        '</td>'+
                    '</tr>';
                }
                    table_str +=  '</table >';
            
            $('#medtable').append(table_str);


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function cleanArray(actual) {
            var newArray = new Array();
            for (var i = 0; i < actual.length; i++) {
                if (actual[i]) {
                newArray.push(actual[i]);
                }
            }
            return newArray;
        }

        $("#add_lab_row").on('click', function() {
            var table = $("#lab_table");
            var count_table_tbody_tr = $("#lab_table tbody tr").length;
            var row_id = count_table_tbody_tr + 1;
            var html = '<tr id="row_'+row_id+'">'+
                '<td>'+ 
                '<input type="search" name="name[]" id="name_'+row_id+'" class="form-control">'+
                '</td>'+ 
                '<td><input type="text" name="price[]" id="price_'+row_id+'" onkeypress ="return isNumber(event)" class="form-control"></td>'+
                '<td><button type="button" class="btn btn-default" id="remove_row_'+row_id+'"><i class="fa fa-minus"></i></button></td>'+
                '</tr>';
            if(count_table_tbody_tr >= 1) {
            $("#lab_table tbody tr:last").after(html);  
            }
            else {
            $("#lab_table tbody").html(html);
            }

            $("#remove_row_"+row_id).on('click',function(){
                alert("Hello");
                $("#lab_table tbody tr#row_"+row_id).remove();
            });
            
        });

        $("#remove_row_"+row_id).on('click',function(){
            alert("Hello");
            $("#lab_table tbody tr#row_"+row_id).remove();
        });

        

    });
    </script>
    
@endsection
{{-- @include('layouts.js') --}}
