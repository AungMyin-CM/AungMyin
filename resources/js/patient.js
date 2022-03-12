import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#isFollowup").on('change',function() {
        if(this.checked) {
           $("#followUp").append(
                        '<div class="form-group" id="followupdate" style="margin:0px !important;">'+
                        '<input type="date" class="form-control" min="2022-03-12"'+
                        'value="2022-03-12" name="followup_date" placeholder="dd-mm-yyyy">'+
                        '</div>'
           );

        }else{
            $("#followupdate").remove();
        }
    });
    
});

})(jQuery);

