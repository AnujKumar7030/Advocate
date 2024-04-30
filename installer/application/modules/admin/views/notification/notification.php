<section class="content-header">
    <h1><?php echo lang('notification') ." ". lang('settings');?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
      
        <li class="active"><?php echo lang('notification') ." ". lang('settings');?></li>
    </ol>
</section>

<section class="content">
    <?php 
    if(validation_errors()) {
        ?>
    <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-ban"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                                        </div>

    <?php  } ?>  
       
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                   
                </div><!-- /.box-header -->
                <!-- form start -->
                
            
                <form method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/notification/')?>">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case_alert_days');?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="number" name="case" value="<?php echo $settings->case_alert;?>" class="form-control">
                                </div>
                            </div>
                        </div>                        
                    
                                   
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('to_do_alert_days');?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="number" name="to_do" value="<?php echo $settings->to_do_alert;?>" class="form-control">
                                </div>
                            </div>
                        </div>        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('appointment_alert_days');?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="number" name="appointment" value="<?php echo $settings->appointment_alert;?>" class="form-control">
                                </div>
                            </div>
                        </div>                
                      
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section>  



<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Client</h4>
      </div>
      <div class="modal-body">
            <form method="post" action="<?php echo base_url('admin/clients/add') ?>">
                     <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" >Name</label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="gender" >Gender</label>
                                    <input type="radio" name="gender" value="Male" /> Male
                                    <input type="radio" name="gender" value="Female" /> Female
                                </div>
                            </div>
                        </div>
               
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="dob" >Date Of Birth</label>
                                    <input type="text" name="dob"  class="form-control datepicker">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="email" >Email</label>
                                    <input type="text" name="email" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="username" >Username</label>
                                    <input type="text" name="username" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="password" >Password</label>
                                    <input type="password" name="password" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="password" >Confirm Password</label>
                                    <input type="password" name="confirm" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" >Contact No.</label>
                                    <input type="text" name="contact" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" >Address</label>
                                    <textarea name="address"  class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
            <?php if(check_user_role(80)==1) {?>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            <?php }?>        
             </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
      </div>
    </div>
  </div>
</div>
