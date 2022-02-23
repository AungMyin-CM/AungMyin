import './bootstrap';

function start_loader() {
    $('body').append('<div class="preloader flex-column justify-content-center align-items-center"></div>')

}

function end_loader() {
    $('.preloader').fadeOut('fast',function () {
        $('.preloader').remove();
    })
}
$("input").on('keyup change',function() {
    $("#alert-message").remove();
})

window.onload = function () {
    end_loader();
  }

start_loader();

