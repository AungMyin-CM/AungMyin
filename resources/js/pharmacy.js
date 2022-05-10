import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $("#sell_price").on('keyup',function(){
        var act_price = $("#act_price").val() == "" ? 0 : $("#act_price").val();
        var sell_price = $(this).val() == "" ? 0 : $(this).val();
        var profit = parseInt(sell_price) - parseInt(act_price);
        var grossMargin = parseInt(profit / act_price * 100)

        $("#margin").val(grossMargin);
        
    })

    $("#margin").on('keyup',function(){
        var act_price = $("#act_price").val() == "" ? 0 : $("#act_price").val();
        var margin = $(this).val() == "" ? 0 : $(this).val();
        var sell_price = parseInt(act_price) + parseInt(act_price * (margin / 100));

        $("#sell_price").val(sell_price);
        
    })

});

})(jQuery);
