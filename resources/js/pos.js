
import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#add_row").on('click', function() {
        var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = '<tr id="row_'+row_id+'">'+
            '<td>'+ 

            '<input type="search" name="med_name[]" id="product_search_'+row_id+'" onkeyup="searchMed('+row_id+')" class="form-control" placeholder="Type your keywords here">'+
            '<input type = "hidden" name = "med_id[]" id = "med_id_'+row_id+'">'+
            '<input type = "hidden" name = "pos_detail_id[]" id = "pos_detail_id_new_'+row_id+'" value="p_new_'+row_id+'">'+
            '<div id="medList_'+row_id+'" style="display:none;position:absolute;width:22.5%;"></div>'+
                '<span id="product_status'+row_id+'" class="label label-danger"></span>'+ 
            '</td>'+ 
            '<td><input type="text" name="expire_date[]" id="expire_date_'+row_id+'" readonly class="form-control"></td>'+
            '<td><input type="text" name="remain_qty[]" id="remain_qty_'+row_id+'" class="form-control"required readonly></td>'+
            '<td><input type="text" name="quantity[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
            '<td><input type="text" name="sell_price[]" id="sell_price_'+row_id+'" class="form-control" readonly>'+
            '<input type="hidden" name="act_price[]" id="act_price_'+row_id+'" class="form-control">'+
            '<input type="hidden" name="unit[]" id="unit_'+row_id+'"" class="form-control">'+
            '<input type="hidden" name="margin[]" id="margin_'+row_id+'"" class="form-control">'+
            '</td>'+
            '<td><input type="text" name="discount[]" id="discount_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
            '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control"  readonly><input type="hidden" name="amount_value[]"  id="amount_value_'+row_id+'" class="form-control"></td>'+
            '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
            '</tr>';

        if(count_table_tbody_tr >= 1) {
        $("#product_info_table tbody tr:last").after(html);  
        }
        else {
        $("#product_info_table tbody").html(html);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    function searchMed() {

            var query = $(this).val();
            
            var clinic_id = $("#clinic_code").val();

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
    };

});
          
});

})(jQuery);

