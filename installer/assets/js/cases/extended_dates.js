(function ($) 
{
  "use strict";
});
    $(function() {
        $('#example1').dataTable({
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
         
