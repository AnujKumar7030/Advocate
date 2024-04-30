(function ($) 
{
  "use strict";
 });   
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

$(function() {
    $(".txtarea").wysihtml5();
});

 $(function() {
    $( ".datepicker" ).pickmeup({
    format  : 'Y-m-d'
});
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
     