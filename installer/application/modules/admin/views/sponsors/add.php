<link href="<?php echo base_url('assets/plugins/chosen/chosen.css')?>" rel="stylesheet" type="text/css" />
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('Content');?> <?php echo lang('sponsors');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/sponsors')?>"> <?php echo lang('sponsors');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
    </ol>
</section>

<section class="content ">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart(''); ?>
                    <div class="box-body">
                        
                       


                        <div class="col-6">
                            <div class="form-group <?php echo form_error('name') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('admin_sponser_form_name'), 'name'); ?> 
                              <span class="required">*</span>
                              <?php 
                                $populateData = $this->input->post('name') ? $this->input->post('name') : (isset($sponsors_data->name) ? $sponsors_data->name :  '' );
                              ?>

                              <input type="text" name="name" id="name" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error"> <?php echo strip_tags(form_error('name')); ?> </span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group <?php echo form_error('logo') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('admin_sponsors_logo'), 'logo'); ?>

                              <span class="required">*</span>
                              <?php 
                                $populateData = isset($sponsors_data->logo) && $sponsors_data->logo ? $sponsors_data->logo :  ''; 
                              ?> 

                              <input type="file" name="logo" id="logo" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error"> <?php echo strip_tags(form_error('logo')); ?> </span> 
                              <?php 
                                if($populateData)
                                {
                              ?> 
                                <div class="">
                                  <img class="image_preview popup" src="<?php echo base_url('assets/images/sponsors/').$populateData; ?>">
                                </div>
                              <?php
                                }
                              ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-12">
                            <div class="form-group <?php echo form_error('link') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('admin_sponsors_form_link'), 'link'); ?> 
                              <span class="required">*</span>
                              <?php 
                                $populateData = $this->input->post('link') ? $this->input->post('link') : (isset($sponsors_data->link) ? $sponsors_data->link :  '' );
                              ?>

                              <input type="text" name="link" id="link" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error"> <?php echo strip_tags(form_error('link')); ?> </span>
                            </div>
                        </div>



                        <div class="clearfix"></div>
                        <div class="col-md-12"><hr /></div>

                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>