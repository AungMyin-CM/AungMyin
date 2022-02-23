import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#clinic_name").on('keyup change',function() {
        $("#error_clinic_name").text('');
    })

    $("#register_clinic").on('click',function(){

        var name = $("#clinic_name").val();
        var packageId = $("input[name='package_id']:checked").val();

        if(name == '') {
            $("#error_clinic_name").text('Clinic name is required');
        }else{

        var checkSession = sessionStorage.getItem("clinicName");

        if(checkSession) {
            sessionStorage.clear();
        }

        sessionStorage.setItem("clinicName", name);
        sessionStorage.setItem('packageId', packageId);

        window.location.href="http://localhost:8000/register-clinic";

        }

    });
    
});

})(jQuery);