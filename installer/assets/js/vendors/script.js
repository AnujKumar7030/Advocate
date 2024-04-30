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
        $('#example1').dataTable({
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

     jQuery('.datepicker').datetimepicker({
     lang:'en',
     i18n:{
      de:{
       months:[
        'Januar','Februar','März','April',
        'Mai','Juni','Juli','August',
        'September','Oktober','November','Dezember',
       ],
       dayOfWeek:[
        "So.", "Mo", "Di", "Mi", 
        "Do", "Fr", "Sa.",
       ]
      }
     },
     timepicker:false,
     format:'Y-m-d'
    });
