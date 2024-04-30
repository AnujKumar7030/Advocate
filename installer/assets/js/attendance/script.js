(function ($) 
{
  "use strict";
});

  jQuery('.datepicker').datetimepicker({
   timepicker:false,
   format:'Y-m-d'
  });

    function areyousure()
    {
        return confirm('Are You Sure ?');
    }

    jQuery('.datepicker').datetimepicker({
      timepicker:false,
      format:'Y-m-d'
    });

    $(function() {
    $('#datable_1').DataTable({
        responsive: true,
        autoWidth: false,
        language: { search: "",
        searchPlaceholder: "Search",
        sLengthMenu: "_MENU_items"

        }
    });
});


