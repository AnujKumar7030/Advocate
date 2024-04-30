<link href="<?php echo base_url('assets/plugins/chosen/chosen.css')?>" rel="stylesheet" type="text/css" />
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('Content');?> <?php echo lang('testimonial');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/testimonial')?>"><?php echo lang('Content');?> <?php echo lang('testimonials');?></a></li>
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
                              <?php echo  form_label(lang('name'), 'name'); ?> 
                              <span class="required">*</span>
                              <?php 
                                $populateData = $this->input->post('name') ? $this->input->post('name') : (isset($testimonial_data->name) ? $testimonial_data->name :  '' );
                              ?>
                              <input type="text" name="name" id="name" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('name')); ?> </span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group <?php echo form_error('profile') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('profile'), 'profile'); ?>

                              <span class="required">*</span>
                              <?php 
                                $populateData = isset($testimonial_data->profile) && $testimonial_data->profile ? $testimonial_data->profile :  ''; 
                              ?> 
                              <input type="file" name="profile" id="profile" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('profile')); ?> </span> 
                              <?php 
                                if($populateData)
                                {
                              ?> 
                                <div class="image_preview_div">
                                  <img class="image_preview popup" src="<?php echo $path_link.$populateData; ?>">
                                </div>
                              <?php
                                }
                              ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-12">
                            <div class="form-group <?php echo form_error('content') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang("message"), 'content'); ?>
                              <span class="required">*</span>
                              <?php
                                $populateData = $this->input->post('content') ? $this->input->post('content') : (isset($testimonial_data->content) ? $testimonial_data->content :  '' );
                              ?>
                              <textarea name="content" id="p_desc" class="form-control editor redactor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('content')); ?> </span>
                            </div>
                        </div>

                      <div class="clearfix"></div>

                      <hr />




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