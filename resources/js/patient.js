import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#isFollowup").on('change',function() {
        if(this.checked) {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

           $("#followUp").append(
                "<div class='form-group' id='followupdate' style='margin:0px !important;'>"+
                "<input type='date' class='form-control'"+
                "value='"+today+"' min='"+today+"' name='followup_date' placeholder='dd-mm-yyyy'>"+
                "</div>"
           );

        }else{
            $("#followupdate").remove();
        }
    });
    
});

})(jQuery);

