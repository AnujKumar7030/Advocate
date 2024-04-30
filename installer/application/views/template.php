<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="en" />
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="theme-color" content="#4188c9">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  
  <link rel="icon" type="image/x-icon" sizes="32x32" href="<?php echo base_url('/assets/uploads/images/').$this->settings_data->favicon; ?>" />

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500,700|Work+Sans:400,700" rel="stylesheet">


  <?php 

    $meta_title = (isset($meta_data['meta_title']) && !empty($meta_data['meta_title']) ? $meta_data['meta_title'] : $this->settings_data->site_name);
  ?>
  <title><?php echo xss_clean($page_title); ?> - <?php echo xss_clean($meta_title); ?></title>
  

         
  
  <?php if (isset($css_files) && is_array($css_files)) : ?>
  <?php foreach ($css_files as $css) : ?>
    <?php if ( ! is_null($css)) : ?>
      <?php $separator = (strstr($css, '?')) ? '&' : '?'; ?>
      <link rel="stylesheet" href="<?php echo xss_clean($css); ?><?php echo xss_clean($separator); ?>v=<?php echo xss_clean($this->settings_data->site_version); ?>"><?php echo "\n"; ?>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>


  <?php
    $login_user_id = $this->user_id;

   $disable_right_click = get_admin_setting('disable_right_click');
   $disable_print_screen = get_admin_setting('disable_print_screen');
   $disable_cut_copy_paste = get_admin_setting('disable_copy_paste_click');
   $hader_logo_height = get_admin_setting('header_logo_height');
   $hader_logo_height = $hader_logo_height > 1 ? $hader_logo_height : 65;


    $flash_error_msg =  $this->session->flashdata('error') ? str_replace("'","`",$this->session->flashdata('error')) : "";
    $flash_success_msg =  $this->session->flashdata('message') ? str_replace("'","`",$this->session->flashdata('message')) : "";

  $user_id =  $this->user_id; 
  $full_name_of_user = '';
  if($this->userdata)
  {
    $full_name_of_user = $this->userdata['name'];
    $is_admin = $this->userdata['user_role'] == 1 ? 1 : 0;
  }
  
  $name_of_user = (strlen($full_name_of_user) > 15) ? substr($full_name_of_user, 0, 10).'...' : $full_name_of_user ;
  
  ?>
  

  <script> 

    var BASE_URL = '<?php echo base_url(); ?>'; 
    var csrf_Name = '<?php echo $this->security->get_csrf_token_name() ?>'; 
    var csrf_Hash = '<?php echo $this->security->get_csrf_hash(); ?>'; 
   

    var flash_message = '<?php echo $flash_success_msg; ?>';
    var flash_error = '<?php echo $flash_error_msg; ?>';

    var error_report = '<?php echo xss_clean($this->error); ?>';
   
    var disable_right_click = '<?php echo xss_clean($disable_right_click); ?>';
    var disable_print_screen = '<?php echo xss_clean($disable_print_screen); ?>';
    var disable_cut_copy_paste = '<?php echo xss_clean($disable_cut_copy_paste); ?>';
   
  </script>


 <style type="text/css">
     <?php if((get_admin_setting('custom_css'))) { echo html_entity_decode(get_admin_setting('custom_css'));} ?>
 </style>


  <script type="text/javascript">  
      <?php if(!empty(get_admin_setting('header_javascript'))) { echo html_entity_decode(get_admin_setting('header_javascript')); } ?>
  </script>




</head>

<body class="h-100">




  <!-- Back to top button -->
  <a id="btt-button"><i class="fas fa-arrow-up"></i></a>


    <div id="app">
      <div class="section">

        <div class=" container-fluid bg-dark py-1 text-white top_header_onfo">
          <div class="container">
              <div class="row px-3 py-1 ">
                
                <div class="col-md-6 my-auto text-small left_info">
                  <?php if(get_admin_setting('contact') != '') { ?>
                    <a class="text-white pr-3 no_underline" href="tel:<?php echo str_replace(' ', '',get_admin_setting('contact')); ?>"><i class="mr-2 fas fa-phone-volume"></i><?php echo get_admin_setting('contact'); ?></a>
                  <?php } ?>
                  <?php if(get_admin_setting('email') != '') { ?>
                    <a class="text-white no_underline" href="mailto:<?php echo get_admin_setting('email'); ?>"> <i class="mr-2 far fa-envelope"></i><?php echo get_admin_setting('email'); ?></a>
                  <?php } ?>
                </div>


                <div class="col-md-6 text-right my-auto text-small right_info">
                  
                  <?php if(get_admin_setting('site_facebook_url')!='') { ?>
                    <!-- Facebook -->
                    <a class="fb-ic" href="<?php echo get_admin_setting('site_facebook_url'); ?>" target="_blank">
                      <i class="fab fa-facebook-f fa-lg  mr-4 text-white"> </i>
                    </a>
                  <?php } ?>

                  <?php if(get_admin_setting('site_twitter_url')!='') { ?>
                    <!-- Twitter -->
                    <a class="tw-ic"  href="<?php echo get_admin_setting('site_twitter_url'); ?>" target="_blank">
                      <i class="fab fa-twitter fa-lg   mr-4 text-white"> </i>
                    </a>
                  <?php } ?>

                  <?php if(get_admin_setting('site_google_plus_url')!='') { ?>
                    <!-- Google +-->
                    <a class="gplus-ic"  href="<?php echo get_admin_setting('site_google_plus_url'); ?>" target="_blank">
                      <i class="fab fa-google-plus-g fa-lg  mr-4 text-white"> </i>
                    </a>
                  <?php } ?>

                  <?php if(get_admin_setting('site_linkedin_url')!='') { ?>
                    <!--Linkedin -->
                    <a class="li-ic"  href="<?php echo get_admin_setting('site_linkedin_url'); ?>" target="_blank">
                      <i class="fab fa-linkedin-in fa-lg  mr-4 text-white"> </i>
                    </a>
                  <?php } ?>

                  <?php if(get_admin_setting('site_instagram_url')!='') { ?>
                    <!--Instagram-->
                    <a class="ins-ic"  href="<?php echo get_admin_setting('site_instagram_url'); ?>" target="_blank">
                      <i class="fab fa-instagram fa-lg  mr-4 text-white "> </i>
                    </a>
                  <?php } ?>

                  <?php if(get_admin_setting('site_pininterest_url')!='') { ?>
                    <!--Pinterest-->
                    <a class="pin-ic"  href="<?php echo get_admin_setting('site_pininterest_url'); ?>" target="_blank">
                      <i class="fab fa-pinterest fa-lg text-white"> </i>
                    </a>
                  <?php } ?>

                </div>

              </div>
          </div>
        </div>
          

        <div class="container-fluid  header_nav"> <!-- bg-dark -->
          <div class="container"> <!-- bg-dark -->
            <input type="hidden" id="main_base_url" value="<?php echo base_url()?>">
            <div class="row">
                <div class="col-md-3 my-auto log_div">
                    <a class="navbar-brand text-white" href="<?php echo base_url()?>"><img style="height: <?php echo $hader_logo_height; ?>;" class="logo" src="<?php echo base_url('/assets/uploads/images/').$this->settings_data->image; ?>" alt='<?php echo $this->settings_data->site_name; ?>'></a>
                </div>
            
             
                <div class="col-md-9 my-auto">

                    <nav class="navbar navbar-expand-lg navbar-dark p-0"><!--  bg-dark -->
                     
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse " id="navbarColor02">
                        <ul class="navbar-nav">

                          <?php

                          if(get_pages_menus_obj())
                          {

                            foreach (get_pages_menus_obj() as $menu) 
                            {
                              $slug_menu = $menu->slug ? $menu->slug : slugify_string($menu->title);
                              ?>
                                <li class="nav-item <?php echo (uri_string() == "page/$slug_menu") ? 'active' : ''; ?> ">
                                  <a class="nav-link" href="<?php echo base_url()."page/$slug_menu"; ?>"><?php echo $menu->title;?>  </a>  
                                </li>
                              <?php
                            }

                          }

                          if(get_case_categories_menus_obj())
                          {
                            foreach (get_case_categories_menus_obj() as $menu) 
                            {
                              $slug_menu = $menu->slug ? $menu->slug : slugify_string($menu->name);
                              ?>
                                <li class="nav-item <?php echo (uri_string() == "service/$slug_menu") ? 'active' : ''; ?> ">
                                  <a class="nav-link" href="<?php echo base_url()."service/$slug_menu"; ?>"><?php echo $menu->name;?>  </a>  
                                </li>
                              <?php
                            }
                          }

                          ?>
                          

                          <li class="nav-item <?php echo (uri_string() == 'contact') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('contact')?>"><?php echo lang('contact'); ?> </a>
                          </li>


                           <?php 
                            if($login_user_id) 
                            { ?>
                                <li class="nav-item <?php echo (uri_string() == 'admin') ? 'active' : ''; ?>">
                                  <a title="Dashboard" class="nav-link text-info" href="<?php echo base_url('/admin'); ?>">
                                    Dashboard
                                  </a>
                                </li>

                                <li class="nav-item <?php echo (uri_string() == 'logout') ? 'active' : ''; ?>">
                                  <a title="Logout" class="nav-link" href="<?php echo base_url('/logout'); ?>">
                                    <i class="h4 fas fa-sign-out-alt"></i>
                                  </a>
                                </li>
                              <?php
                            }  
                            else
                            { ?>

                              <li class="nav-item <?php echo (uri_string() == 'login') ? 'active' : ''; ?>">
                                    <a title="Sign In" class="nav-link" href="<?php echo base_url('admin/login'); ?>">
                                       <i class="h4 fas fa-sign-in-alt"></i>
                                    </a>
                              </li>

                              <?php
                            }
                            ?> 


                          
                        </ul>
                      </div>
                    </nav>
                </div>
            </div>
          </div>
        </div>



        <?php // Main body ?>

        <?php if(($this->session->flashdata('message') OR $this->session->flashdata('error') OR $this->error) && 1==2) : ?>
        <div class="container-fluid body_background">
           <div class="container">
            <?php // System messages ?>
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissable flashdata">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php elseif ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissable flashdata">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>

            <?php elseif ($this->error) : ?>
                <div class="alert alert-danger alert-dismissable flashdata">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->error; ?>
                </div>
            <?php endif; ?>
          </div>
        </div>

        <?php endif; ?>



        <?php // Main content ?>
        <?php echo $content; ?>

        <!-- Footer -->
        <footer class="page-footer font-small special-color-dark ">

          <?php 
          if($this->settings_data->cookies_content_display == "YES")
          { ?>

            <!-- START Bootstrap-Cookie-Alert -->
            <div class="alert text-center cookiealert" role="alert">
              <?php echo $this->settings_data->cookies_content; ?>

              <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
                 <?php echo $this->settings_data->cookies_content_btn_text; ?>
              </button>
            </div>
            <!-- END Bootstrap-Cookie-Alert -->  <?php
          } ?>

         <?php
         $first_f_section = 0;
         $second_f_section = 0;
         $third_f_section = 0;
         if($this->settings_data->footer_text_heading OR $this->settings_data->site_footer_text)
         {
            $first_f_section = 1;
         }

         if(get_case_categories_menus_obj())
         {
            $second_f_section = 1;
         }

         if(get_pages_menus_obj())
         {
            $third_f_section = 1;
         }
         $f_colum_size = 4;
         $total_avil_f_sec = $first_f_section + $second_f_section + $third_f_section;
         if($total_avil_f_sec == 2)
         {
            $f_colum_size = 6;
         }
         if($total_avil_f_sec == 1)
         {
            $f_colum_size = 12;
         }

          if($this->settings_data->footer_text_heading OR $this->settings_data->site_footer_text OR get_case_categories_menus_obj() OR get_pages_menus_obj())
          { ?>
            <div class="container-fluid bg-dark p-5">
              <div class="container">
                <!-- Grid row -->
                <div class="row">

                  <?php
                  if($this->settings_data->footer_text_heading OR $this->settings_data->site_footer_text)
                  { ?>
                    <!-- Grid column -->
                    <div class="col-md-<?php echo $f_colum_size; ?> mt-md-0 mt-3 text-white">

                      <!-- Content -->
                      <h5 class="text-uppercase font-weight-bold text-white">   <?php echo $this->settings_data->footer_text_heading; ?></h5> 
                      <p class="text-white">
                         <?php echo $this->settings_data->site_footer_text; ?>
                      </p>
                    </div>
                 
                    <!-- Grid column --> <?php
                  } 

                  if(get_case_categories_menus_obj())
                  { ?>
                    <!-- Grid column -->
                    <div class="col-md-<?php echo $f_colum_size; ?> mx-auto">

                      <!-- Links -->
                      <h5 class="font-weight-bold text-uppercase  mb-3 pl-4 text-white"><?php echo lang('Services'); ?></h5>
                      <ul class="list-styled text-white category__">
                        <?php
                        foreach (get_case_categories_menus_obj() as $menu) 
                        {
                          $slug_menu = $menu->slug ? $menu->slug : slugify_string($menu->name);
                          ?>
                            <li>
                              <a class="text-white text-link" href="<?php echo base_url()."service/$slug_menu"; ?>"><?php echo $menu->name;?> </a>
                            </li>
                          <?php
                        } ?>
                      </ul>
                    </div>
                    <!-- Grid column --> <?php 
                  } 

                  if(get_pages_menus_obj())
                  { ?>
                    <!-- Grid column -->
                    <div class="col-md-<?php echo $f_colum_size; ?> mx-auto">

                      <!-- Links -->
                      <h5 class="font-weight-bold text-uppercase  mb-3 pl-4  text-white"><?php echo lang('Pages'); ?></h5>
                      <ul class="list-styled text-white category__">
                        <?php
                        foreach (get_pages_menus_obj() as $menu) 
                        {
                          $slug_menu = $menu->slug ? $menu->slug : slugify_string($menu->title);
                          ?>
                            <li>
                              <a class="text-white text-link" href="<?php echo base_url()."page/$slug_menu"; ?>"><?php echo $menu->title;?> </a>
                            </li>
                          <?php
                        } ?>
                      </ul>
                    </div>
                    <!-- Grid column --> <?php 
                  } ?>

                </div> <!-- Grid row -->
              </div><!-- Footer-container end -->
            </div><!-- Footer-container-fluid end --> <?php
          } ?>

          <?php
          if($this->settings_data->footer_last_row_left_text OR $this->settings_data->footer_last_row_right_text)
          { ?>
             <!-- Copyright -->
            <div class="bg-primary footer-copyright text-center py-3 text-white">
              <div class="container">
                <div class="row">

                  <?php
                  if(empty($this->settings_data->footer_last_row_left_text) OR empty($this->settings_data->footer_last_row_right_text))
                  {
                    $footer_bottom_text = $this->settings_data->footer_last_row_left_text ? $this->settings_data->footer_last_row_left_text : $this->settings_data->footer_last_row_right_text;
                    ?>
                       <div class="col-md-12 text-center">
                          <?php echo $footer_last_row_left_text; ?>
                        </div>
                    <?php
                  }
                  else
                  {
                    ?>
                        <div class="col-md-6 text-left">
                          <?php echo $this->settings_data->footer_last_row_left_text; ?>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo $this->settings_data->footer_last_row_right_text; ?>
                        </div>
                    <?php
                  } ?>
                </div>
              </div>
            </div> <?php
          } ?>

        </footer>
        <!-- Footer -->

      </div>
    </div>



      <?php // Javascript files ?>
      <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
          <?php $separator = (strstr($js, '?')) ? '&' : '?'; ?>
          <?php echo "\n"; ?><script type="text/javascript" src="<?php echo xss_clean($js); ?>"></script><?php echo "\n"; ?>
        <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      <script type="text/javascript">  
          <?php if(!empty(get_admin_setting('footer_javascript'))) { echo html_entity_decode(get_admin_setting('footer_javascript')); } ?>
      </script>








    <div class="modal fade" id="quiz_all_in_one_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content quiz_all_in_one_modal_content">
          <div class="modal-header">
            <h2 class="modal-title quiz_all_in_one_modal_title text-info text-uppercase" id="quiz_all_in_one_modal_title">Modal title</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body quiz_all_in_one_modal_body">
            ...
          </div>
          <div class="modal-footer quiz_all_in_one_modal_footer">
            <a href="javascript:void(0)" class="btn btn-warning quiz_all_in_one_modal_footer_action">Action</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</body>
</html>