(function ($) 
{
  "use strict";

  
     
});

    $(document).ready(function(){

          $('form').submit(function() {
              $('.btn').attr('disabled', true).addClass('disabled');
          });


      $('.redactor').redactor({
              minHeight: 200,
              imageUpload: '<?php echo base_url(config_item('admin_folder').'/wysiwyg/upload_image');?>',
              fileUpload: '<?php echo base_url(config_item('admin_folder').'/wysiwyg/upload_file');?>',
              imageGetJson: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/get_images');?>',
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

    $(function() {
        $('#example1').dataTable({
        });
    });

    function areyousure()
    {
        return confirm('are you sure ?');
    }
