<div class="h-100 my-5">
  <div class="width-100 content_page header-background" >
    <div class="container content_page">
     <h1 class="content_page_title text-uppercase"> <?php echo xss_clean($service_data->name); ?></h1>
    </div>
  </div>

  <?php

    if($child_services)
    { ?>
      <div class="container content_page mt-5">
          <div class="row"> 
            <?php
            foreach ($child_services as  $child_service) 
            {
              $slug_menu = $child_service->slug ? $child_service->slug : slugify_string($child_service->name);
               ?>
                 <div class="col-md-3 col-xl-2 col-sm-6 text-center my-auto">
                    <a href='<?php echo base_url("service/$slug_menu")?>'><h2 class="px-2 py-5 text-uppercase border"><?php echo $child_service->name; ?></h2></a>
                 </div>
               <?php
            } ?>
        </div>
      </div>
      <?php
    }
  ?>



  <div class="container content_page">
    	<div class="row"> 
        <div class="col-md-12 col-xl-12 col-sm-12 mt-5" >
        	<?php echo xss_clean($service_data->description); ?>
        </div>
    	</div>
  </div>

</div>