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


    $(document).on('change', '#is_case', function(){
      vch = $(this).val();
         
        if(vch==0){
            $("#case").hide();
            
        }
        if(vch==1){
            $("#case").show();
           
        }
        

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


    
    var max_fields      = 20; //maximum input boxes allowed
    
    var x = 1; //initlal text box count
    $(document).on('click','.add_field_button',function(e)
    {
        e.preventDefault(false);
        if(x < max_fields)
        {   
            
            x++; //max input box allowed //text box increment

            var AddMoreHtml = $("#document_upload_add_more").html();
            $('.after_add_more_section').append(AddMoreHtml);
        }
        else
        {
            alert('max upload limit cross');
        }
    });
    
    $(document).on("click", ".remove_field", function(e)
    { 
        e.preventDefault(); 

        $(this).parents(".copied_section").remove();
        x--;

    });



