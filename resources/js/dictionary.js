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
                    url: '/fetchDictionary',
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
                url: '/fetchDictionary',
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

})

})(jQuery);