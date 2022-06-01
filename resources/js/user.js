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

    $("#ph_view").on("change",function() {
        if(this.checked)
        {
            $("#ph_create,#ph_delete,#ph_update").prop('checked', true);
        }else{
            $("#ph_create,#ph_delete,#ph_update").prop('checked', false);

        }
    });

    $("#ph_create,#ph_delete,#ph_update").on('change', function() {
        if(this.checked)
        {
            $("#ph_view").prop('checked', true);
        }
    });

    $("#pos_view").on("change",function() {
        if(this.checked)
        {
            $("#pos_create,#pos_delete,#pos_update").prop('checked', true);
        }else{
            $("#pos_create,#pos_delete,#pos_update").prop('checked', false);

        }
    });

    $("#pos_create,#pos_delete,#pos_update").on('change', function() {
        if(this.checked)
        {
            $("#pos_view").prop('checked', true);
        }
    });

    $('#role_type').on('change', function() {
        if(this.value != 1){

            document.getElementById("doctor_section").setAttribute('hidden','hidden');
            document.getElementById("short_bio").setAttribute('hidden','hidden');
            document.getElementById("fees").setAttribute('hidden','hidden');

        }else{
            document.getElementById("doctor_section").removeAttribute('hidden');
            document.getElementById("short_bio").removeAttribute('hidden');
            document.getElementById("fees").removeAttribute('hidden');

        }
    });

    
});

})(jQuery);


