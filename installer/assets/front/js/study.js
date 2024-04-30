$(document).ready(function(){
	$('.video-file').on('click',function(){
		$(this).find('#player').removeClass('d-none');
		
	});

	/* 1. Visualizing things on Hover - See next part for action on click */
		$("#stars li").on("mouseover", function () {
			var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

			// Now highlight all the stars that's not after the current hovered star
			$(this)
				.parent()
				.children("li.star")
				.each(function (e) {
					if (e < onStar) {
						$(this).addClass("hover");
					} else {
						$(this).removeClass("hover");
					}
				});
		}).on("mouseout", function () {
			$(this)
				.parent()
				.children("li.star")
				.each(function (e) {
					$(this).removeClass("hover");
				});
		});

		/* 2. Action to perform on click */
		$("#stars li").on("click", function () {

			var onStar = parseInt($(this).data("value")); // The star currently selected
			var stars = $(this).parent().children("li.star");
			var hidd = $('.rate').val(onStar);

			for (var i = 0; i < stars.length; i++) {

				$(stars[i]).removeClass("selected");

			}

			for (var i = 0; i < onStar; i++) {
				$(stars[i]).addClass("selected");
			}

			// JUST RESPONSE (Not needed)
			var ratingValue = parseInt(
				$("#stars li.selected").last().data("value"),
				10
			);
			var msg = "";
			if (ratingValue > 1) {
				msg = "Thanks! You rated this " + ratingValue + " stars.";
			} else {
				msg =
					"We will improve ourselves. You rated this " + ratingValue + " stars.";
			}
			responseMessage(msg);
		});

		function responseMessage(msg) 
		{
			$(".success-box").fadeIn(200);
			$(".success-box div.text-message").html("<span>" + msg + "</span>");
		}

	//like and disklike product review
	$(document).on('click','.thumbs-up i',function(e)
	{
		var element = $(this);
		var rel_type = $(this).data('rel_type');
		if($(this).hasClass('review-not-visit'))
		{
			var ids = $(this).data('review_id');
			$.ajax({
		        url: BASE_URL+"Study_Controller/review_like_insert",
		        type: "POST",
		        data:{review_id:ids,rel_type:rel_type},
		        success:function(result)
		        {
		        	result = JSON.parse(result);
		        	console.log(result.success);

		        	if(result.success)
		        	{
		        		$('#change-color_'+ids).removeClass('review-not-visit');
		        		$('#change-color_'+ids).addClass('review-like');
		        		 
		        		element.next('.total-likes').html(result.success.total_like);
		        	}
		        	else if(result.status == 'redirect')
		        	{
		        		window.location.href = BASE_URL+'login';
		        	}
		        	else if(result.error == 'unsuccessfull')
		        	{
		    			alert('Something happen wrong');    		
		        	}
		        },
		        error:function(e)
		        {
		        	console.log(e)
		        },        
	      	});
		}
		else
		{
			var ids = $(this).data('review_id');
			var element = $(this)
			$.ajax({
				url: BASE_URL+"Study_Controller/review_delete",
				type: "POST",
				data: {review_id:ids,rel_type:rel_type},
				success:function(result)
				{
					result = JSON.parse(result);
					if(result.successfull)
					{
						$('#change-color_'+ids).removeClass('review-like');
		        		$('#change-color_'+ids).addClass('review-not-visit');
		        		
		        		{	
		        			element.next('.total-likes').html(result.successfull.total_like);
		        		}
					}
					else if(result.status == 'redirect')
		        	{
		        		window.location.href = BASE_URL+'login';
		        	}
		        	else if(result.error == 'unsuccessfull')
		        	{
		    			alert('Something happen wrong');    		
		        	}
				},
				error:function(e)
				{
					console.log(e);
				},
			});
		}
	});	





    $(document).ready(function()
    {
        // Add down arrow icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-up");
        });
        // Toggle up and down arrow icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-up").addClass("fa-angle-down");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-up");
        });


	$(document).on('click','.data_section_contant_check_box',function(e)
	{
		var s_m_contant_id = $(this).val();
		var s_m_id = $("#active_study_matrial_id").val();
		var s_m_section_id = $(this).data('s_m_section_id');
		var clicked_check_box = $(this);
		var study_data_total_file = $("#study_data_total_file").val();
		var current_complete_percentage = $("#current_complete_percentage").val();

		if(s_m_contant_id && s_m_id)
		{

			$.ajax({
		        url: BASE_URL+"Study_Controller/complete_sm_contant",
		        type: "POST",
		        data:{s_m_contant_id:s_m_contant_id,s_m_id:s_m_id,s_m_section_id:s_m_section_id},
		        success:function(result)
		        {
		        	result = JSON.parse(result);
		        	console.log(result.status);

		        	if(result.status == 'success')
		        	{
		        		$("#accordionExample .section_has_complete").text(result.s_m_s_complete_count);
		        		var new_progress_per = Math.round((result.complete_count*100)/study_data_total_file);
		        		adjust_progress_bar(current_complete_percentage, new_progress_per)
		        		$("#total_contant_has_complete").text(result.complete_count);

		        		if(result.action == 'complete')
		        		{
    						$(clicked_check_box).prop('checked',true);
		        		}
		        		else
		        		{
		        			 $(clicked_check_box).prop('checked',false);
		        		}
		        		// window.location.href = BASE_URL+'login';
		        	}
		        	else
		        	{
		        		$.notify({ message: result.message },{ type: 'danger'});
		        	}
		        },
		        error:function(e)
		        {
		        	console.log(e)
		        },        
	      	});
		}
		else
		{
			$.notify({ message: 'something went wrong' },{ type: 'danger'});
		}

		
	});


	$(document).on('click','.go_to_next_contant',function(e)
	{
		e.preventDefault();
		var s_m_contant_id = $(this).data('id_value');
		var s_m_id = $("#active_study_matrial_id").val();
		var s_m_section_id = $(this).data('s_m_section_id');
		var next_contant_url = $(this).data('next_url');
		var this_button = $(this);

		if(s_m_contant_id && s_m_id)
		{

			$.ajax({
		        url: BASE_URL+"Study_Controller/complete_sm_contant_and_go_to_next",
		        type: "POST",
		        data:{s_m_contant_id:s_m_contant_id,s_m_id:s_m_id,s_m_section_id:s_m_section_id},
		        success:function(result)
		        {
		        	result = JSON.parse(result);
		        	console.log(result.success);
		        	console.log(next_contant_url);

		        	if(result.status == 'success')
		        	{
		        		window.location.href = next_contant_url;
		        	}
		        	else
		        	{
		        		if(result.action == 'jump_to_next')
		        		{
		        			window.location.href = next_contant_url;
		        		}
		        		else
		        		{
			        		$.notify({ message: result.message },{ type: 'danger'});	
		        		}
		        	}
		        },
		        error:function(e)
		        {
		        	console.log(e)
		        },        
	      	});
		}
		else
		{
			$.notify({ message: 'something went wrong' },{ type: 'danger'});
		}

		
	});


    });


    function adjust_progress_bar(current_percentage, new_progress_per)
    {
    	$("#current_complete_percentage").val(new_progress_per);
        var i = current_percentage;
        if(i < new_progress_per)
        {
	          var counterBack = setInterval(function () 
	          {
	            i++;
	            if (i < new_progress_per || i == new_progress_per) 
	            {
	              $('.progress-barr .progress-bar').css('width', i + '%');
	              $('.progress-barr .progress-bar').attr('aria-valuenow', i);
	              $('.progress-barr .span').text(i + '%');
	            } 
	            else 
	            {
	                clearInterval(counterBack);
	            }

	          }, 10);
	    }
	    else
	    {

	      	var counterBack_m = setInterval(function () 
	          {
	            i--;
	            if (i > new_progress_per || i == new_progress_per) 
	            {
	              $('.progress-barr .progress-bar').css('width', i + '%');
	              $('.progress-barr .progress-bar').attr('aria-valuenow', i);
	              $('.progress-barr .span').text(i + '%');
	            } 
	            else 
	            {
	                clearInterval(counterBack_m);
	            }

	          }, 10);

	    }

    }


	var url_study_material_content_id = $("#url_study_material_content_id").val();
	var is_contant_reasing_page = $("#is_contant_reasing_page").val();

	if(url_study_material_content_id != "" && is_contant_reasing_page)
	{
		var scrollToElement = function(el, ms)
		{
		    var speed = (ms) ? ms : 600;
		    $('html,body').animate({
		        scrollTop: $(el).offset().top
		    }, speed);
		} 
		scrollToElement('#study_data_contant', 600);
	}

	$("#study_data_contant_btn").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#study_data_contant").offset().top
    }, 1000);
});

});