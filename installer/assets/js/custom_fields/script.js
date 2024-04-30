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
     
    $(function() {
            $( "#datepicker" ).pickmeup({
            format  : 'Y-m-d'
        });
    });


    $(document).on('ready', function(){
         $('#value-div').hide();
});

$(document).on('change', '#field', function(){
     var field = $('#field').val();
    if(field==3 || field==2 || field==4){
        $('#value-div').show();
    }else{
        $('#value-div').hide();
    }
 
});
