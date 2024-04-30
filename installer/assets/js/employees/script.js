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

    $('#datable_1').DataTable({
        responsive: true,
        autoWidth: false,
        language: { search: "",
        searchPlaceholder: "Search",
        sLengthMenu: "_MENU_items"

        }
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


$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row mt-5" ><div class="col-md-2"></div><div class="col-md-4"><input type="text" name="title[]" value="" class="form-control" placeholder="Title" /></div><div class="col-md-4"><input type="file" name="doc[]" value="" class="form-control" /></div><a href="#" class="remove_field btn btn-danger">Remove</a></div></div>'); //add input box
            $('.chzn').chosen({search_contains:true});
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$(document).on('change', '#department_id', function(){
 
    department_id = $('#department_id').val();
    var BASE_URL = $('.base-url').val();
    var ajax_link = BASE_URL+"admin/employees/get_degi";
    //$('#degi').html(ajax_load);
          
      $.ajax({
        url: ajax_link,
        type:'POST',
        data:{id:department_id},
        
        success:function(result){
          
          $('#degi').html(result);
          
         }
    });
});

