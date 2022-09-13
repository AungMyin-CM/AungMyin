@extends("layouts.app")

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Dictionary Form</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active">New</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Please fill out form</h3>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div><br />
                                    @endif
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ route('dictionary.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code" name="code" required
                                                    placeholder="Code">
                                            </div>
                                            <div class="form-group float-right">
                                                <input type="checkbox" id="is_med" name="is_med" value="1">
                                                <label for="med">Is Medicine</label>    
                                            </div>
                                            <div class="form-group" id= "dictonary_div">
                                                <label for="meaing">Meaning</label>
                                                <textarea class="form-control" placeholder="Meaning" name="meaning" rows="7">{{ old('meaning') }}</textarea>
                                            </div>
                                            <div id="med_div" hidden="hidden">
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <table class="table table-bordered" id="product_info_table">
                                                            <thead>
                                                              <tr>
                                                                <th style="width:45%">Name</th>                                                   
                                                                <th style="width:25%">Qty</th>
                                                                <th style="width:20%">Days</th>
                                                                <th ><button type="button" id="add_dic_med_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                                              </tr>
                                                            </thead>   
                                                             <tbody>
                                                               <tr id="row_1">
                                                                 <td>
                                                                      <input type="text" name="med_name[]" id="product_search_1" onkeyup="searchMed('1')" class="form-control" placeholder="Search Medicine">
                                                                      <input type = "hidden" name = "med_id[]" id = "med_id_1">
                                                                      <div id="medList_1" style="display:none;position:absolute;width:35%;">
                                                                    </div>
                                                                </td>
                                                                  
                                                                  <td>
                                                                    <input type="text" name="quantity[]" id="qty_1" class="form-control"></td>           
                                                                  <td>
                                                                    <input type="number" name="days[]" id="days_1" class="form-control" >  
                                                                  </td>
                                                                  
                                                               </tr>
                                                             </tbody>
                                                          </table>              
                                                  </section>
                                            </div>          
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <input type="submit" class="btn btn-primary" value="Submit">
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
    <script src="{{ asset('js/dictionary.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
        });

        function searchMed(rowid) {
            var query = $("#product_search_"+rowid).val();
            var clinic_id = {{ session()->get('cc_id') }}
            $.ajax({
                type: "POST",
                url: '/clinic-system/searchMed',
                data: { key: query, clinic_id: clinic_id, rowid: rowid}
            }).done(function( response ) {         
            if(query != '')
            {
                $('#medList_'+rowid).css("display","block");  
                $('#medList_'+rowid).html(response);
            }
            else{
                $('#medList_'+rowid).css("display","none");  
                $('#medList_'+rowid).html("");
            }
            });
        };
        function s_option(rowid)
        {
            var med_id = rowid.getAttribute("data-id");
            var med_name = rowid.getAttribute("data-name");
            var row_id = rowid.getAttribute("row-id");
            $("#product_search_"+row_id).val(med_name);
            $("#med_id_"+row_id).val(med_id);      
            $('#medList_'+row_id).css("display","none");  
            $('#medList_'+row_id).html("");
            
        }
        function removeRow(tr_id)
        {
            $("#product_info_table tbody tr#row_"+tr_id).remove();
        }

    </script>
@endsection
{{-- @include('layouts.js') --}}
