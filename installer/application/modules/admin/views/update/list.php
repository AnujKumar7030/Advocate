<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<section class="content-header">
    <h1><?php echo lang('Updates');?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
      
        <li class="active"><?php echo lang('Updates');?></li>
    </ol>
</section>


<section class="content">
   <div class="row">
      
     <div class="col-md-12">
         <div class="box box-primary">
               
               <div class="box-body">
                  <div class="col-md-12 my-5">
                     <form method="POST" action="<?php echo base_url('admin/updates/token_update'); ?>">
                        <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />

                        <div class="row">
                           <div class="col-md-10">
                              <div class="form-group">
                                 <input class="form-control" value="<?php echo $this->settings_data->site_update_token; ?>" name="site_update_token" placeholder="Site Purchage Code">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <button  type="submit" class="btn btn-success btn-block">Save</button>
                              </div>
                           </div>
                        </div>
                     </form>
               
                  </div>
                  <div class="row updates">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                           <div class="card-body">

                                 <div class="w-100 text-center">
                                    
                                    <?php 
                                    if($purchase_code_is_verified) 
                                    {
                                       
                                          if($next_version_name)
                                          { 
                                             ?>

                                             <div class="col-6 text-left">
                                                <h4>Current Version <?php echo isset($response['current_version_name']) ? $response['current_version_name'] : ''; ?></h4>
                                                
                                             </div>

                                             <div class="col-6 text-right">
                                                <h4>Latest Version  <?php echo $next_version_name; ?></h4>
                                             </div>

                                             <div class="col-12 my-5">
                                                <iframe src="<?php echo $api_url; ?>next_version_update_info.php?version=<?php echo $local_current_version_code; ?>&slug=advocate"  class="w-100 border-0" style="height: 400px !important;"> title="<?php echo lang('next_updates_details')?>"></iframe>
                                             </div>

                                             <div class="col-12 text-center h-100">
                                                <?php echo $next_version_description;  ?>
                                             </div>


                                             <?php
                                             if($is_copy_working)
                                             { 
                                                echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate' ,'class'=>'w-100')); ?> 
                                                <div class="col-12 my-5 text-center w-100">
                                                   <input type="submit" name="download" value="Upgrade To latest Version" class="btn btn-primary">
                                                </div>
                                                <?php echo form_close();
                                             }
                                             else
                                             { ?>

                                                <div class="col-12 my-5">
                                                   <h6 class="text-center text-danger"> Please download the latest version from below link, than extract and upload on project's root directory.</h6>
                                                   <div class="text-danger text-center">
                                                      *** Imp: Always keep maintenance mode active while uploading the files. 
                                                   </div>
                                                   
                                                </div>
                                                <?php 
                                                $download = $next_version_all_in_one_zip ? "download" : "#";
                                                $next_version_all_in_one_zip = $next_version_all_in_one_zip ? $next_version_all_in_one_zip : "#";
                                                ?>

                                                <div class="col-12 my-5 text-center w-100">
                                                   <a href="<?php echo $next_version_all_in_one_zip; ?>" <?php echo $download; ?>  class="btn btn-primary">Download Update</a>
                                                   
                                                </div>
                                                <?php
                                             }
                                          }
                                          else
                                          {
                                             echo "<div class='col-12 text-center>'><h4 class='text-success'>".lang('You are On Latest Version !')."</h4></div>";
                                             echo "<div class='col-12 text-center>'><a href='".base_url('admin/updates/check_update')."' class='btn btn-info'>".lang('Check for update')."</a></div>";
                                             ?>
                                             <div class="col-12 my-5">
                                                 <iframe src="<?php echo $api_url; ?>all_version_update_info.php?slug=advocate"  class="w-100 border-0" style="height: 200px !important;"> title="<?php echo lang('updates_details')?>"></iframe>

                                             </div>
                                             <?php 
                                          }            
                                    }
                                    else
                                    {
                                       ?>
                                          
                                       <?php
                                       echo "<div class='col-12 text-center>'><h4 class='text-danger'>".$update_info_message."</h4></div>"; 
                                    }
                                    ?>
                                    <div class="clearfix"></div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
</section>


