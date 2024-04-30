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

    $(function() {
        
        // $('#example1').dataTable({
        //      aLengthMenu: [
        //     [25, 50, 100, 200, -1],
        //     [25, 50, 100, 200, "All"]
        // ],
        // iDisplayLength: -1
        // });
        /*
        $('#langForm').on('submit', function(){
           $('#example1').DataTable().search('').draw(false);
        });*/
    });

