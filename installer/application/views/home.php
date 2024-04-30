<h6 class="d-none"><?php echo lang('ADVOCATE'); ?></h6>
   <?php
   if($this->settings_data->home_first_slide OR $this->settings_data->home_slide_second OR $this->settings_data->home_third_slide)
   { ?>
      <div>
         <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="30000000">
            <div class="carousel-inner">
               
               <?php
               if($this->settings_data->home_first_slide)
               { ?>
                  <div class="carousel-item active">

                     <?php
                     if($this->settings_data->home_first_slide_text OR $this->settings_data->home_first_slide_button_text)
                     { ?>
                        <div class="slide_button_or_text">
                           <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-8">
                                 <div class="width-100 w-100 content_area">
                                    <?php
                                    if($this->settings_data->home_first_slide_text)
                                    { ?>
                                       <h1><?php echo $this->settings_data->home_first_slide_text; ?></h1> <?php
                                    } ?>

                                    <?php
                                    if($this->settings_data->home_first_slide_button_text)
                                    { ?>
                                        <a href="<?php echo $this->settings_data->home_first_slide_button_link; ?>" class="btn btn-dark"><?php echo $this->settings_data->home_first_slide_button_text; ?></a><?php
                                    } ?>
                                 </div>
                              </div>
                              <div class="col-md-2"></div>
                           </div>
                        </div><?php 
                     } ?>

                     <img src="<?php echo base_url('/assets/uploads/images/').$this->settings_data->home_first_slide; ?>" alt='<?php echo $this->settings_data->site_name; ?>' class="d-block w-100" >
                  </div>  <?php
               } ?>
               
               <?php
               if($this->settings_data->home_slide_second)
               { 
                  $active_slider = empty($this->settings_data->home_first_slide) ? "active" : "";
                  ?>
                  <div class="carousel-item <?php echo $active_slider; ?>">



                     <?php
                     if($this->settings_data->home_second_slide_text OR $this->settings_data->home_second_slide_button_text)
                     { ?>
                        <div class="slide_button_or_text">
                           <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-8">
                                 <div class="width-100 w-100 content_area">
                                    <?php
                                    if($this->settings_data->home_second_slide_text)
                                    { ?>
                                       <h1><?php echo $this->settings_data->home_second_slide_text; ?></h1> <?php
                                    } ?>

                                    <?php
                                    if($this->settings_data->home_second_slide_button_text)
                                    { ?>
                                        <a href="<?php echo $this->settings_data->home_second_slide_button_link; ?>" class="btn btn-dark"><?php echo $this->settings_data->home_second_slide_button_text; ?></a><?php
                                    } ?>
                                 </div>
                              </div>
                              <div class="col-md-2"></div>
                           </div>
                        </div><?php 
                     } ?>


                     <img src="<?php echo base_url('/assets/uploads/images/').$this->settings_data->home_slide_second; ?>" alt='<?php echo $this->settings_data->site_name; ?>' class="d-block w-100" > 
                  </div>  <?php
               } ?>
               
               
               <?php
               if($this->settings_data->home_third_slide)
               { 
                  $active_slider = (empty($this->settings_data->home_first_slide) && empty($this->settings_data->home_slide_second)) ? "active" : "";
                  ?>
                  <div class="carousel-item  <?php echo $active_slider; ?>">



                     <?php
                     if($this->settings_data->home_third_slide_text OR $this->settings_data->home_third_slide_button_text)
                     { ?>
                        <div class="slide_button_or_text">
                           <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-8">
                                 <div class="width-100 w-100 content_area">
                                    <?php
                                    if($this->settings_data->home_third_slide_text)
                                    { ?>
                                       <h1><?php echo $this->settings_data->home_third_slide_text; ?></h1> <?php
                                    } ?>

                                    <?php
                                    if($this->settings_data->home_third_slide_button_text)
                                    { ?>
                                        <a href="<?php echo $this->settings_data->home_third_slide_button_link; ?>" class="btn btn-dark"><?php echo $this->settings_data->home_third_slide_button_text; ?></a><?php
                                    } ?>
                                 </div>
                              </div>
                              <div class="col-md-2"></div>
                           </div>
                        </div><?php 
                     } ?>


                     <img src="<?php echo base_url('/assets/uploads/images/').$this->settings_data->home_third_slide; ?>" alt='<?php echo $this->settings_data->site_name; ?>' class="d-block w-100" > 
                  </div>  <?php
               } ?>
                              
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </div> <?php 
   } ?>

   <?php
   if($this->settings_data->display_content_on_home_page)
   { ?>      
      <div class="home_page_client_content w-100">
         <?php echo $this->settings_data->display_content_on_home_page; ?>            
      </div> <?php

   } ?>
    

   <?php
   if($testimonials)
   { ?>
      <section class="client">
         <div class="container">
            

            <div class="row">
               <div class="col-12">
                  <h3 class="h3">
                     <span class="text-danger"><?php echo lang('Our '); ?></span> <?php echo lang('Testimonials'); ?> 
                  </h3>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="our-testimonials">
                     <?php
                        foreach ($testimonials as  $testimonial) 
                        {
                           $testimonial->content = strip_tags($testimonial->content);
                           $content = substr($testimonial->content,0,200) . '...';
                           $test_profile_logo = "noimg.png";
                           $test_profile_logo = base_url('assets/default')."/".$test_profile_logo;
                           if($testimonial->profile)
                           {
                              $db_test_profile_logo = base_url("assets/uploads/testimonial")."/$testimonial->profile";
                              if(file_exists("./assets/uploads/testimonial/$testimonial->profile"))
                              {
                                 $test_profile_logo = $db_test_profile_logo;
                              }

                              
                           }

                           ?>

                              <div class="slide testimonials_slide p-2">
                                 <div class=" w-100 text-center box">
                                   
                                    <img class="home_testimonial_img p-2" src="<?php echo $test_profile_logo;?>" alt="<?php echo $this->settings_data->site_name; ?>">
                                    <div class="w-100 message p-4"><?php echo get_string_with_limit($content, 100); ?></div>
                                    <h3 class="text-center"><?php echo $testimonial->name; ?></h3>
                                              
                                  </div>
                              </div>

                           <?php
                        } ?>
                    
                 </div>
              </div>
            </div>
         </div>
      </section><?php
   }?>

   <?php
   if($sponsors)
   { ?>
        <section class="client">
            <div class="container">
               
               <div class="row">
                  <div class="col-12">
                     <h3 class="h3">
                        <span class="text-danger"><?php echo lang('Our Brand'); ?></span> <?php echo lang('Partners'); ?> 
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="carousel-brand-patnar"><?php
                        foreach ($sponsors as  $sponsor) 
                        { 

                           $sponsor_profile_logo = "noimg.png";
                           $sponsor_profile_logo = base_url('assets/default')."/".$sponsor_profile_logo;
                           if($sponsor->logo)
                           {
                              $db_sponsor_profile_logo = base_url("assets/uploads/sponsors")."/$sponsor->logo";
                              if(file_exists("./assets/uploads/sponsors/$sponsor->logo"))
                              {
                                 $sponsor_profile_logo = $db_sponsor_profile_logo;
                              }
                             
                           }

                           ?>

                           <div class="slide">
                              <div class=" w-100 text-center">
                                 <a href="<?php echo 'javascript:void(0)'; ?>" class="no_underline" >
                                    <img class=" p-2 hom_sponser_img" src="<?php echo $sponsor_profile_logo;?>" alt="<?php echo $this->settings_data->site_name; ?>">
                                 </a>                  
                               </div>
                           </div>
                           <?php 
                        } ?>   
                    </div>
                 </div>
               </div>
            </div>
        </section> <?php

   }?>