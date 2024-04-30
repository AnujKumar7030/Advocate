(function ($) 
{
  "use strict";

   
});

    $('#datable_1').DataTable({
        responsive: true,
        autoWidth: false,
        language: { search: "",
        searchPlaceholder: "Search",
        sLengthMenu: "_MENU_items"

        }
    });
    
    function areyousure()
    {
        return confirm('<?php echo lang("are_you_sure");?>');
    }