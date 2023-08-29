import jQuery from "jquery";

(function($){ "use strict";

$(function() {


    var dictCode = '';

    $("#dictionary").on('keypress keydown',function(event) {
            var key = event.keyCode;
            var evtType = event.type;

            if(evtType == 'keydown'){
                if(key ==8){
                    dictCode = dictCode.slice(0,-1);
                }
           }
           if(evtType == 'keypress'){
         
            if(key == 13 || key == 32) 
            {   
                if(dictCode != '') {
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: '/clinic-system/fetchDictionary',
                    data: { key: dictCode}
                }).done(function( response ) {
                    if(response != ''){
                        var obj = JSON.parse(response);
                        var vall = $('#dictionary').val();
                        vall = vall.slice(0, -(obj.code.length+1));                
                       $('#dictionary').val(vall+obj.meaning);
                    }
                });
                }
                dictCode = '';
            }else{
                dictCode += event.key;
            }        
           }
        });



    $("#diagnosis_dictionary").on('keypress keydown',function(event) {
        var key = event.keyCode;
        var evtType = event.type;

        if(evtType == 'keydown'){
            if(key ==8){
                dictCode = dictCode.slice(0,-1);
            }
       }
       if(evtType == 'keypress'){
     
        if(key == 13 || key == 32) 
        {   
            if(dictCode != '') {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "POST",
                url: '/clinic-system/fetchDictionary',
                data: { key: dictCode}
            }).done(function( response ) {
                if(response != ''){
                    var obj = JSON.parse(response);
                    var vall = $('#diagnosis_dictionary').val();
                    vall = vall.slice(0, -(obj.code.length+1));                
                   $('#diagnosis_dictionary').val(vall+obj.meaning);
                }
            });
            }
            dictCode = '';
        }else{
            dictCode += event.key;
        }        
       }
    });

    
    $("#is_med").on("change",function() {
        if(this.checked)
        {
            document.getElementById("dictonary_div").setAttribute('hidden','hidden');
            document.getElementById("med_div").removeAttribute('hidden','hidden');
        }else{
            document.getElementById("dictonary_div").removeAttribute('hidden','hidden');
            document.getElementById("med_div").setAttribute('hidden','hidden');
        }
    });

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
            '<td><input type="text" name="quantity[]" id="qty_'+row_id+'" class="form-control" autocomplete="off"></td>'+           
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

})(jQuery);