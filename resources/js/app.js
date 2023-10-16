import './bootstrap';

$("input").on('keyup change',function() {
    $("#alert-message").remove();
    $("input").removeClass('is-invalid');
})

