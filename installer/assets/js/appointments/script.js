(function ($) 
{
  "use strict";
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This Appointment');
    }

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


  $(function() {
      
      $('.chzn').chosen();
      
  });


  $(function() {
      //bootstrap WYSIHTML5 - text editor
      $(".txtarea").wysihtml5();
  });

   $(function() {
     $('.datetimepicker').datetimepicker({
      //mask:'9999-19-39 29:59',
      format  : 'Y-m-d H:i'
      
      }
      
      );
    });


