(function ($) 
{
  "use strict";

});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
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

    $(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row" style="padding-top:10px;"><div class="col-md-2"></div><div class="col-md-4"><input type="text" name="title[]" value="" class="form-control" placeholder="Title" /></div><div class="col-md-4"><input type="file" name="doc[]" value="" class="form-control" /></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div>'); //add input box
            $('.chzn').chosen({search_contains:true});
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
