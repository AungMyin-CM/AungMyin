import jQuery from "jquery";

(function($){ "use strict";

$(function() {

    $( "#main_search" ).autocomplete({  
        source: [  
            { label: "Daisy", value: "DAS" },  
            { label: "Dandelion", value: "DAD" },  
            { label: "Daffodil", value: "DAF" },  
            { label: "Dahlia", value: "DAH" },  
            { label: "Desert Rose", value: "DER" }  
        ]  
    });  

    })

})(jQuery);