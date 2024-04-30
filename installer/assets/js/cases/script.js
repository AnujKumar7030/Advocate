(function ($) 
{
  "use strict";
         
});  
    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
    $(function() {
        $('#example1').dataTable({
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
            $( "#datepicker" ).pickmeup({
            format  : 'Y-m-d'
        });
    });
     