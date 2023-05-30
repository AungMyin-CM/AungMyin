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
                                    <form action="{{ route('procedure.store') }}" method="POST">
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
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="procedure">Procedure</option>
                                                            <option value="investigation">Investigation</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="code">Code</label>

                                                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required placeholder="Eg: ..." value="{{old("code")}}" >
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

                                            <div id="med_div">
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <table class="table table-bordered" id="lab_table">
                                                            <thead>
                                                              <tr>
                                                                <th style="width:40%">Name</th>                                                   
                                                                <th>Price</th>
                                                                <th ><button type="button" id="add_lab_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                                              </tr>
                                                            </thead>   
                                                             <tbody>
                                                               <tr id="row_1">
                                                                 <td>
                                                                      <input type="text" name="name[]" id="name_1" class="form-control">
                                                                </td>
                                                                  
                                                                  <td>
                                                                    <input type="text" name="price[]" id="price_1" class="form-control" onkeypress="return isNumber(event)"></td>       
                                                                  
                                                               </tr>
                                                             </tbody>
                                                          </table>              
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
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
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
                '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
                '</tr>';
            if(count_table_tbody_tr >= 1) {
            $("#lab_table tbody tr:last").after(html);  
            }
            else {
            $("#lab_table tbody").html(html);
            }
        });

        function removeRow(tr_id)
        {
            $("#lab_table tbody tr#row_"+tr_id).remove();
        }
    </script>
    
@endsection
{{-- @include('layouts.js') --}}
