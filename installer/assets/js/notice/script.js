(function ($) 
{
  "use strict";
         
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
    
    $(function() {
    
        $('.chzn').chosen();
        
    });

    $(function() {
        $('#datable_1').DataTable({
            responsive: true,
            autoWidth: false,
            language: { 
                search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items"

            }
        });
    });

    $(function() {
        //bootstrap WYSIHTML5 - text editor
        $(".txtarea").wysihtml5();
    });

    $(function() {
        $( "#datepicker" ).pickmeup({
            format  : 'Y-m-d'
        });
    });

    $(function() {
        $('.datetimepicker').datetimepicker({
            format  : 'Y-m-d',
            timepicker:false
        });
    });
