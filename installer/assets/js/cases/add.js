$(function() {
    
    $('.chzn').chosen();
    
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



$(document).on('change', '#location_id', function(){
   vch = $(this).val();
  $('#court_category_result').html(ajax_load);
  var ajax_link = BASE_URL+"admin/cases/get_court_categories";
  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      $('#court_category_result').html(result);
      $(".chzn").chosen();
     }
  });
});


$(document).on('change', '#court_category_id', function(){
   location_id = $('#location_id').val();
   c_c_id         = $('#court_category_id').val();
  $('#court_result').html(ajax_load);
  var ajax_link = BASE_URL+"admin/cases/get_courts";
  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{l_id:location_id,c_id:c_c_id},
    
    success:function(result){
      $('#court_result').html(result);
      $(".chzn").chosen();
     }
  });
});

$( "#my_form" ).submit(function( event ) {
    name = $('#name').val();
    
    gender = $('#gender').val();
    dob = $('#dob').val();
    email = $('#email').val();
    username = $('#username').val();
    password = $('#password').val();
    conf = $('#confirm').val();
    contact = $('#contact').val();
    address = $('#address').val();
    var ajax_link = BASE_URL+"admin/clients/add_client";
    $.ajax({
        url: ajax_link,
        type:'POST',
        data:{name:name,gender:gender,dob:dob,email:email,username:username,password:password,confirm:conf,contact:contact,address:address},
        
        success:function(result){
              if(result=="Success")
                {
                     $('#myModal').modal('hide');
                     window.close(); 
                     location.reload();
                }
                else
                {
                    $('#err').html(result);
                }
          
          $(".chzn").chosen();
         }
      });
    
    event.preventDefault();
});


