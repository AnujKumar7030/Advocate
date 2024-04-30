(function ($) 
{
  "use strict";

     
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
    
    $(function() 
    {
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


$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row pt-5"><div class="col-md-2"></div><div class="col-md-4"><input type="text" name="title[]" value="" class="form-control" placeholder="Title" /></div><div class="col-md-4"><input type="file" name="doc[]" value="" class="form-control" /></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div>'); //add input box
            $('.chzn').chosen({search_contains:true});
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

// $(document).ready(function()
//     {
//         $('.redactor').redactor({
//                 minHeight: 200,
//                 imageUpload:  admin_folder_wysiwyg+'upload_image',
//                 fileUpload:   admin_folder_wysiwyg+'upload_file',
//                 imageGetJson: admin_folder_wysiwyg+'get_images',
//                 imageUploadErrorCallback: function(json)
//                 {
//                     alert(json.error);
//                 },
//                 fileUploadErrorCallback: function(json)
//                 {
//                     alert(json.error);
//                 }
//           });
//     });

    