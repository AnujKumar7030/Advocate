(function ($) 
{
  "use strict";

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  var sticky_header = $('.sticky-header-top').data('sticy');

  // this script needs to be loaded on every page where an ajax POST

  $(document).ready(function () 
  {
      $.ajaxSetup({
        data: {
          [csrf_Name]: csrf_Hash,
        },
      });

    $(window).scroll(function(){
      var sticky = $('.sticky_top'),
          scroll = $(window).scrollTop();
      if (scroll >= 100 && sticky_header == 'YES') sticky.addClass('fixed_header');
      else sticky.removeClass('fixed_header');

      var theme_or_profile_section = $('.theme_or_profile_section');

      if(scroll >= 70)
      {
         theme_or_profile_section.addClass('theme_or_profile_section_mobile_display_none');
      }
      else
      {
        theme_or_profile_section.removeClass('theme_or_profile_section_mobile_display_none');
      }
    });



  $(".no_quiz_start").on("click", function (e) {
    var link = $(this).attr("href");

    if (login_user_id == 0 && ad_active_quiz == "") {
      e.preventDefault();
      swal({
          title: "Enter Your Name",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          inputPlaceholder: "Write Your Name Here",
        },
        function (inputValue) {
          if (inputValue === false) return false;
          if (inputValue === "") {
            swal.showInputError("Plz Enter Name First!");
            return false;
          } else {
            var base_url = $("#main_base_url").val();

            $.ajax({
              type: "POST",
              url: BASE_URL + "quiz_Controller/set_leader_bord_user_name",
              data: {
                inputValue: inputValue,
              },

              success: function (response) {
                if (response) {
                  response = JSON.parse(response);
                  if (response.status != "error") {
                    window.location.href = link;
                  } else {
                    swal("Error",response.msg, "error");
                    location.reload();
                  }
                } else {
                  swal("Error","Server Response Error", "error");
                }
              },
              error: function (e) {
                console.log(e);
              },
            });
          }
        }
      );
    } else {
      location.reload();
    }
  });



  });
  

  /**
   * Configurations
   */ 
  var config = {
    logging: true,
    baseURL: BASE_URL,
  };

  /**
   * Bootstrap IE10 viewport bug workaround
   */
  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement("style");
    msViewportStyle.appendChild(
      document.createTextNode("@-ms-viewport{width:auto!important}")
    );
    document.querySelector("head").appendChild(msViewportStyle);
  }

  /**
   * Execute an AJAX call
   */
  function executeAjax(url, data, callback) {
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      dataType: "json",
      async: true,
      success: function (results) {
        callback(results);
      },
      error: function (error) 
      {
        swal("Error","Error " + error.status + ": " + error.statusText , "error");
      },
    });
    // prevent default action
    return false;
  }

  /**
   * Global core functions
   */
  $(document).ready(function () {
    /**
     * Session language selected
     */
    $("#session-language-dropdown a").on('click', function (e) {
      // prevent default behavior
      if (e.preventDefault) {
        e.preventDefault();
      } else {
        e.returnValue = false;
      }

      // set up post data
      var postData = {
        language: $(this).attr("rel"),
      };

      // define callback function to handle AJAX call result
      var ajaxResults = function (results) {
        if (results.success) {
          location.reload();
        } 
        else 
        {
          swal("Error","core error session_language", "error");
        }
      };

      // perform AJAX call
      executeAjax(
        config.baseURL + "ajax/set_session_language",
        postData,
        ajaxResults
      );
    });
  });

  // function to set a given theme/color-scheme
  function setTheme(themeName) {
    localStorage.setItem("theme", themeName);
    document.documentElement.className = themeName;
  }

  $(".toggleTheme").on("change", function (c) {
    toggleTheme();
  });
  // function to toggle between light and dark theme
  function toggleTheme() {
    if (localStorage.getItem("theme") === "theme-dark") {
      setTheme("theme-light");
    } else {
      setTheme("theme-dark");
    }
  }

  // Immediately invoked function to set the theme on initial load
  (function () {

    var slider_div = document.getElementById("slider");
    if(slider_div)
    {
      
      var theme_color = localStorage.getItem("theme");
      if(theme_color)
      {
        if (localStorage.getItem("theme") === "theme-dark") {
          setTheme("theme-dark");
          document.getElementById("slider").checked = false;
        } else {
          setTheme("theme-light");
          document.getElementById("slider").checked = true;
        }

      }
      else
      {
        if(set_default_theme_in_dark_mode == 'YES')
        {
          setTheme("theme-dark");
          document.getElementById("slider").checked = false;
        }
        else
        {
          setTheme("theme-light");
          document.getElementById("slider").checked = true;
        }
      }
  }

  })();

  $(function () {
    var header = $(".start-style");
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 10) {
        header.removeClass("start-style").addClass("scroll-on");
      } else {
        header.removeClass("scroll-on").addClass("start-style");
      }
    });
  });

  //Animation

  $(document).ready(function () 
  {
    $("body.hero-anime").removeClass("hero-anime");
  });






  $(document).on("change", "#registration_form #institution_id", function (e)
  {
    var dropdown_identity = "#registration_form #course_id";
    var institution_id = $(this).val();
    if(institution_id)
    {
      get_courses_by_instutaion_id(institution_id,dropdown_identity);
    }
  });

  function get_courses_by_instutaion_id(institution_id, dropdown_identity)
  {
      $(dropdown_identity).html('');
      $.ajax({
        url: BASE_URL + "user/get_courses_by_instute_id/"+institution_id,
        type: "POST",
        data: { institution_id: institution_id, },
        success: function (result) 
        {
          result = JSON.parse(result);
          if (result.options) 
          {
            var options = result.options;
             $(dropdown_identity).html(options); 
            // $.each(options, function (id, text) 
            // {
            //   console.log(text);
            //     $(dropdown_identity).append($('<option>', { 
            //         value: id,
            //         text : text 
            //     }));
            // });         
          } 
          else 
          {
            swal("Error",result.message, "error");
          } 
        },
        error: function (e) 
        {
          console.log(e);
        },
      });
  }

  $(document).on("click", ".like_study_material", function (e)
  {

    var study_id = $(this).data("study_id");
    var element = $(this);
      $.ajax({
        url: BASE_URL + "study-like/like_study",
        type: "POST",
        data: { study_id: study_id, },
        success: function (result) 
        {
          result = JSON.parse(result);
          if (result.status == "success") 
          {
            if(result.action == 'like')
            {
              $(".like_study_material_box_"+study_id).removeClass("text-dark");
              $(".like_study_material_box_"+study_id).addClass("text-success");

              $(".like_study_material_box_b_"+study_id).removeClass("text-white");
              $(".like_study_material_box_b_"+study_id).addClass("text-success");
              
              $(".like_study_material_i_"+study_id).removeClass("text-dark");
              $(".like_study_material_i_"+study_id).addClass("text-success");

              $(".like_study_material_span_"+study_id).removeClass("text-dark");
              $(".like_study_material_span_"+study_id).addClass("text-success");
              $(".like_study_material_span_"+study_id).text(result.like_count.total_like);
              

              $(".like_study_material_i_b_"+study_id).removeClass("text-white");
              $(".like_study_material_i_b_"+study_id).addClass("text-success");
              

              $(".like_study_material_span_b_"+study_id).removeClass("text-white");
              $(".like_study_material_span_b_"+study_id).addClass("text-success");
              $(".like_study_material_span_b_"+study_id).text(result.like_count.total_like);
              
            }
            else
            {
              $(".like_study_material_box_"+study_id).removeClass("text-success");
              $(".like_study_material_box_"+study_id).addClass("text-dark");

              $(".like_study_material_box_b_"+study_id).removeClass("text-success");
              $(".like_study_material_box_b_"+study_id).addClass("text-white");
              
              $(".like_study_material_i_"+study_id).removeClass("text-success");
              $(".like_study_material_i_"+study_id).addClass("text-dark");

              $(".like_study_material_span_"+study_id).removeClass("text-success");
              $(".like_study_material_span_"+study_id).addClass("text-dark");
              $(".like_study_material_span_"+study_id).text(result.like_count.total_like);
              

              $(".like_study_material_i_b_"+study_id).removeClass("text-success");
              $(".like_study_material_i_b_"+study_id).addClass("text-white");
              

              $(".like_study_material_span_b_"+study_id).removeClass("text-success");
              $(".like_study_material_span_b_"+study_id).addClass("text-white");
              $(".like_study_material_span_b_"+study_id).text(result.like_count.total_like);
            }
          } 
          else 
          {
            swal("Error",result.message, "error");
          } 
        },
        error: function (e) 
        {
          console.log(e);
        },
      });
  });



  $(document).on("click", ".like_unlike_quiz", function (e)
  {

    var quiz_id = $(this).data("quiz_id");
    var element = $(this);
      $.ajax({
        url: BASE_URL + "like/like_quiz",
        type: "POST",
        data: { quiz_id: quiz_id, },
        success: function (result) 
        {
          result = JSON.parse(result);
          if (result.status == "success") 
          {
            if(result.action == 'like')
            {
              $(".like_quiz_view_box_"+quiz_id).removeClass("text-dark");
              $(".like_quiz_view_box_"+quiz_id).addClass("text-success");

              $(".like_quiz_view_box_b_"+quiz_id).removeClass("text-white");
              $(".like_quiz_view_box_b_"+quiz_id).addClass("text-success");
              
              $(".like_quiz_view_i_"+quiz_id).removeClass("text-dark");
              $(".like_quiz_view_i_"+quiz_id).addClass("text-success");

              $(".like_quiz_view_span_"+quiz_id).removeClass("text-dark");
              $(".like_quiz_view_span_"+quiz_id).addClass("text-success");
              $(".like_quiz_view_span_"+quiz_id).text(result.like_count.total_like);
              

              $(".like_quiz_view_i_b_"+quiz_id).removeClass("text-white");
              $(".like_quiz_view_i_b_"+quiz_id).addClass("text-success");
              

              $(".like_quiz_view_span_b_"+quiz_id).removeClass("text-white");
              $(".like_quiz_view_span_b_"+quiz_id).addClass("text-success");
              $(".like_quiz_view_span_b_"+quiz_id).text(result.like_count.total_like);

              $(".like_quiz_view_span_b_l_"+quiz_id).removeClass("text-white");
              $(".like_quiz_view_span_b_l_"+quiz_id).addClass("text-success");
              $(".like_quiz_view_span_b_l_"+quiz_id).text(result.like_count.total_like+' Like');
              
            }
            else
            {
              $(".like_quiz_view_box_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_box_"+quiz_id).addClass("text-dark");

              $(".like_quiz_view_box_b_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_box_b_"+quiz_id).addClass("text-white");
              
              $(".like_quiz_view_i_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_i_"+quiz_id).addClass("text-dark");

              $(".like_quiz_view_span_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_span_"+quiz_id).addClass("text-dark");
              $(".like_quiz_view_span_"+quiz_id).text(result.like_count.total_like);
              

              $(".like_quiz_view_i_b_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_i_b_"+quiz_id).addClass("text-white");
              

              $(".like_quiz_view_span_b_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_span_b_"+quiz_id).addClass("text-white");
              $(".like_quiz_view_span_b_"+quiz_id).text(result.like_count.total_like);

              $(".like_quiz_view_span_b_l_"+quiz_id).removeClass("text-success");
              $(".like_quiz_view_span_b_l_"+quiz_id).addClass("text-white");
              $(".like_quiz_view_span_b_l_"+quiz_id).text(result.like_count.total_like+' Like');
            }
          } 
          else 
          {
            swal("Error",result.message, "error");
          } 
        },
        error: function (e) 
        {
          console.log(e);
        },
      });
  });



  $(".quiz_sharing_buttons").on("click", function (e) 
  {
    $('#share_button_modal').modal('show');
  });

  $(".difficulty_level_model").on("click", function (e) 
  {
    var category_slug = $(this).data("category_slug");
    var element = $(this);
      $.ajax({
        url: BASE_URL + "category-difficulty/"+category_slug,
        type: "POST",
        data: {
          category_slug: category_slug
        },
        success: function (result) {
          result = JSON.parse(result);
          if (result.status == 'success') 
          {
            $(".quiz_all_in_one_modal_body").html(result.html);
            $(".quiz_all_in_one_modal_title").html(result.title);
            $(".quiz_all_in_one_modal_footer_action").html("View All Quiz Of Category");
            $(".quiz_all_in_one_modal_footer_action").attr("href", result.action)
            $('#quiz_all_in_one_modal').modal('show');
          } 
          else
          {
                new Noty({
                  type: "error",
                  layout: "topRight",
                  text: result.message,
                  timeout: 5000,
                  progressBar: true,
                  theme: "mint",
                  closeWith: ["click", "button"],
                }).show();
          }
        },
        error: function (e) 
        {
          console.log(e);
        },
      });
  });

})(jQuery);

if(disable_right_click == 'YES')
{

  $(document).ready(function(){
   $(document).bind("contextmenu",function(e){
      isIntextMenuOpen = true;
     return false;
   });
  });


  var isIntextMenuOpen ;

  function hideContextmenu(e){
         if(isIntextMenuOpen ){
              console.log("contextmenu closed ");
         }

       isIntextMenuOpen = false;
  }
  $(window).blur(hideContextmenu);

  $(document).click(hideContextmenu);


  document.onkeydown = function(e) {
    if(event.keyCode == 123) {
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
       return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
       return false;
    }
  }
}

if(disable_print_screen == 'YES')
{ 


  $('body').focus();

   document.addEventListener("keydown", function (e) 
   {
      var keyCode = e.keyCode ? e.keyCode : e.which;

              if (keyCode == 44) 
              {
                  stopPrntScr();
              }

  });

   document.addEventListener("keyup", function (e) 
   {
      var keyCode = e.keyCode ? e.keyCode : e.which;

              if (keyCode == 44) 
              {
                  stopPrntScr();
              }

  });
  function stopPrntScr() 
  {
    var inpFld = document.createElement("input");
    inpFld.setAttribute("value", ".");
    inpFld.setAttribute("width", "0");
    inpFld.style.height = "0px";
    inpFld.style.width = "0px";
    inpFld.style.border = "0px";
    document.body.appendChild(inpFld);
    inpFld.select();
    document.execCommand("copy");
    inpFld.remove(inpFld);
  }
   function AccessClipboardData() { 
        try {
            window.clipboardData.setData('text', "Access   Restricted");
        } catch (err) {
        }
    }
    setInterval("AccessClipboardData()", 300);
}





  if (flash_message == "undefined") 
  {
    var flash_message = "";
  }
  if (flash_error == "undefined") {
    var flash_error = "";
  }
  // if(flash_validation == 'undefined'){ var flash_validation = ''; }
  if (error_report == "undefined") {
    var error_report = "";
  }

  if (flash_message) {
    new Noty({
      type: "success",
      layout: "topRight",
      text: flash_message,
      timeout: 5000,
      progressBar: true,
      theme: "metroui ",
      closeWith: ["click", "button"],
    }).show();
  }

  if (flash_error) {
    new Noty({
      type: "error",
      layout: "topRight",
      text: flash_error,
      timeout: 5000,
      progressBar: true,
      theme: "mint",
      closeWith: ["click", "button"],
    }).show();
  }

  if (error_report) {
    new Noty({
      type: "error",
      layout: "topRight",
      text: error_report,
      timeout: 5000,
      progressBar: true,
      theme: "mint",
      closeWith: ["click", "button"],
    }).show();
  }


  var btn = $("#back-to-top-button");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({
      scrollTop: 0
    }, "300");
  });

  $(document).ready(function() {
    $('.select2').select2();
    // $('#selectcategory').trigger("change");

    /**********************/
    /*  Client carousel   */
    /**********************/


    $('.carousel-brand-patnar').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 2,
      dots: true,
      centerMode: true,
      focusOnSelect: true,
      autoplay:true,
      mobileFirst:true,//add this one

    });
   
    $('.carousel-rated-advocate').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 2,
    dots: true,
    centerMode: true,
    focusOnSelect: true

    });

    $('.our-testimonials').slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 1,
    dots: true,
    centerMode: true,
    focusOnSelect: true

    });


});

