import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $(window).on('load',function(){

        var name = sessionStorage.getItem("clinicName");
        var package_id = sessionStorage.getItem("packageId");
        $("#clinicName").text(name);
        $("#clinic_input_name").val(name);
        $("#package_id").val(package_id);
        
        if(name == null) {
            window.location="http://localhost:8000/clinic-name";
        }
        
    });
    
});

})(jQuery);