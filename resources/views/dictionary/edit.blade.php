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
                                    <form method="post" action="{{ route('dictionary.update', $dictionary->id) }}">

                                        @csrf
                                        @method('PATCH')

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="code" class="form-control" id="code" name="code"
                                                    placeholder="Code" value="{{ $dictionary->code }}" autocomplete="off">
                                            </div>
                                          
                                            @if($dictionary->isMed == 1)
                                                <div class="form-group">
                                                    <label for="med">Medicine</label>    
                                                    <input type="checkbox" id="med" name="isMed"
                                                    value="1" {{ $dictionary->isMed == 1 ? 'checked' : ''}} onclick="return false;">
                                                </div> 
                                            @endif
                                            @if($dictionary->isMed == 1)
                                                <span id="med_data" hidden>{{$dictionary->meaning}}</span>
                                                <div id="med_div">
                                                    <section class="content">
                                                        <div class="container-fluid" id="medtable">
                                                            
                                                    </section>
                                                </div>          
                                            @else
                                                <div class="form-group">
                                                    <label for="meaning">Meaning</label>
                                                    <textarea class="form-control" rows="7" placeholder="Meaning" name="meaning" autocomplete="off">{{ $dictionary->meaning }}</textarea>
                                                </div>
                                            @endif

                                            
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" style="background-color: {{config('app.color')}}">Submit</button>
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
@endsection

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/dictionary.js') }}"></script>



<script>
    $(document).ready(function(){
        
        var med_data = $("#med_data").text().toString();
        const res = med_data.split("<br>");

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var fil_res = res.filter(function (el) {
            return el != "";
        });

        var table_str = '<table class="table table-bordered" id="product_info_table">'+ 
                        '<thead>'+
                        '<th style="width:45%">Name</th>'+                                              
                        '<th style="width:25%">Qty</th>'+
                        '<th style="width:20%">Days</th>'+
                        '<th ><button type="button" id="add_dic_med_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>'+
                        '</thead>';
            
            for (i =0; i<fil_res.length ; i++){

                data = res[i].split('^');
            
                table_str +=
                '<tr id="row_'+i+'">'+
                    '<td><input type="hidden"  name="med_id[]"  class="form-control" value="'+data[0]+'" /> '+
                    '<input type="text" name="med_name[]" id="product_search_'+i+'" onkeyup="searchMed('+i+')" class="form-control" value="'+data[1]+'" autocomplete="off"/>'+
                    '<div id="medList_'+i+'" style="display:none;position:absolute;width:35%;"></div>'+
                    '</td>'+
                    '<td><input type="text"  name="med_qty[]" id="qty_'+i+'" class="form-control" value="'+data[2]+'" autocomplete="off"/></td>'+
                    '<td><input type="text"   name="days[]"  id="days_'+i+'" class="form-control" value="'+data[3]+'" autocomplete="off"/></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+i+'\')" id="remove_row_'+i+'"><i class="fa fa-minus"></i></button></td>'+

                    '</td>'+
                '</tr>';
            }
            table_str +=  '</table >';
        
        $('#medtable').append(table_str);

        $("#add_dic_med_row").on('click', function() {
        var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = '<tr id="row_'+row_id+'">'+
            '<td>'+ 
            '<input type="search" name="med_name[]" id="product_search_'+row_id+'" onkeyup="searchMed('+row_id+')" class="form-control" placeholder="Search Medicine" autocomplete="off">'+
            '<input type = "hidden" name = "med_id[]" id = "med_id_'+row_id+'">'+
            '<div id="medList_'+row_id+'" style="display:none;position:absolute;width:35%;"></div>'+
            '</td>'+ 
            '<td><input type="text" name="med_qty[]" id="qty_'+row_id+'" class="form-control" autocomplete="off"></td>'+           
            '<td><input type="number" name="days[]" id="days_'+row_id+'" class="form-control" autocomplete="off"></td>'+
            '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
            '</tr>';
        if(count_table_tbody_tr >= 1) {
        $("#product_info_table tbody tr:last").after(html);  
        }
        else {
        $("#product_info_table tbody").html(html);
        }
    });
        
    })

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
{{-- @include('layouts.js') --}}
