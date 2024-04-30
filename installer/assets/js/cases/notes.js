(function ($) 
{
  "use strict";
         
});    
    var ajax_link = BASE_URL+"";

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
   
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