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
        language: { search: "",
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


    $(function () {       
        $(".knob").knob({  });
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
         autoclose:true,
         timepicker:false,
         format:'Y-m-d'
    });


  $(document).ready(function(){
      
    $('.slider').ionRangeSlider();
    
    $('.redactor').redactor({
            minHeight: 400,
            imageUpload:  admin_folder_wysiwyg+'upload_image',
            fileUpload:   admin_folder_wysiwyg+'upload_file',
            imageGetJson: admin_folder_wysiwyg+'get_images',         
            imageUploadErrorCallback: function(json)
            {
                alert(json.error);
            },
            fileUploadErrorCallback: function(json)
            {
                alert(json.error);
            }
      });
});
