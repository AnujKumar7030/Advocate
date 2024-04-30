(function ($) 
{
  "use strict";
         
});    
  function areyousure()
  {
      return confirm('are you sure ?');
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
    
    $('.chzn').chosen();
    
});
 //Handle starring for glyphicon and font awesome
  $(".fa-star, .fa-star-o, .glyphicon-star, .glyphicon-star-empty").click(function(e) {
      e.preventDefault();
      //detect type
      var glyph = $(this).hasClass("glyphicon");
      var fa = $(this).hasClass("fa");

      //Switch states
      if (glyph) {
          $(this).toggleClass("glyphicon-star");
          $(this).toggleClass("glyphicon-star-empty");
      }

      if (fa) {
          $(this).toggleClass("fa-star");
          $(this).toggleClass("fa-star-o");
      }
  });


$(".Privat").click(function (e) {
    e.preventDefault();
  vch = $(this).text();

  var ajax_link = BASE_URL+"admin/cases/set_starred";
      
  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
     }
  });
  
  
});        


$(".Public").click(function (e) {
    e.preventDefault();
      vch = $(this).text();
  var ajax_link = BASE_URL+"admin/cases/update_set_starred";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
     }
  });
  
  
});    



$(document).on('change', '#client_id', function(){
 
     vch = $(this).val();
  $('#result').html(ajax_load);
  
  var ajax_link = BASE_URL+"admin/cases/get_case_by_client";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});


$(document).on('change', '#court_id', function(){
 
     vch = $(this).val();
  $('#result').html(ajax_load);
  
  var ajax_link = BASE_URL+"admin/cases/get_case_by_court";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});


$(document).on('change', '#location_id', function(){
 
     vch = $(this).val();
  
  $('#result').html(ajax_load);
  
  var ajax_link = BASE_URL+"admin/cases/get_case_by_location";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      //alert(result);return false;
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});

$(document).on('change', '#case_stage_id', function(){
 
     vch = $(this).val();
 
  $('#result').html(ajax_load);
  
  var ajax_link = BASE_URL+"admin/cases/get_case_by_case_stage_id";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});


$(document).on('change', '#date1', function(){

     vch = $(this).val();
  
  $('#result').html(ajax_load);
   
  var ajax_link = BASE_URL+"admin/cases/get_case_by_case_filing_date";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});

$(document).on('change', '#date2', function(){
 
     vch = $(this).val();
  
  $('#result').html(ajax_load);
  
  var ajax_link = BASE_URL+"admin/cases/get_case_by_case_hearing_date";

  $.ajax({
    url: ajax_link,
    type:'POST',
    data:{id:vch},
    success:function(result){
      
      $('#result').html(result);
      $(".chzn").chosen();
      $('#example1').dataTable({});
     }
  });
});
            
                

