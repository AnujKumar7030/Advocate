(function ($) 
{
  "use strict";
         
});

    $(document).ready(function(){

        $(function() {
            
            $('.chzn').chosen();
            
        });

        $(function() {
            //bootstrap WYSIHTML5 - text editor
            $(".txtarea").wysihtml5();
        });

        $(function() {
              $( ".datepicker" ).pickmeup({
              format  : 'Y-m-d'
          });
        });


    });


      $(document).ready(function(){

    $('.redactor').redactor({
            minHeight: 200,
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
      