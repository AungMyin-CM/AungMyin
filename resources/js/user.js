import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#p_view").on("change",function() {
        if(this.checked)
        {
            $("#p_create,#p_delete,#p_update,#p_treatment").prop('checked', true);
        }else{
            $("#p_create,#p_delete,#p_update,#p_treatment").prop('checked', false);

        }
    })

    $("#p_create,#p_delete,#p_update,#p_treatment").on('change', function() {
        if(this.checked)
        {
            $("#p_view").prop('checked', true);
        }
    });

    $("#d_view").on("change",function() {
        if(this.checked)
        {
            $("#d_create,#d_delete,#d_update").prop('checked', true);
        }else{
            $("#d_create,#d_delete,#d_update").prop('checked', false);

        }
    });

    $("#d_create,#d_delete,#d_update").on('change', function() {
        if(this.checked)
        {
            $("#d_view").prop('checked', true);
        }
    });

    
});

})(jQuery);


