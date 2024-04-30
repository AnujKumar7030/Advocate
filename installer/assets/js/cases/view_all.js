(function ($) 
{
  "use strict";
           
});  
    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
   

    $(function() {
        $('#example1').dataTable({
        });
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
     