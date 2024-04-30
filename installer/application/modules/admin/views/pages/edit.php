<link href="<?php echo base_url('assets/plugins/chosen/chosen.css')?>" rel="stylesheet" type="text/css" />
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('Content');?> <?php echo lang('Page');?>
        <small><?php echo lang('update');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/pages')?>"><?php echo lang('Content');?> <?php echo lang('page');?></a></li>
        <li class="active"><?php echo lang('update');?></li>
    </ol>
</section>

<section class="content ">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('update');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart(); ?>
                    <div class="box-body">
                        
                        <div class="col-md-8">
                                    
                            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('title'), 'title'); ?> 
                              <span class="required">*</span>
                              <?php 
                                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($page_data->title) ? $page_data->title :  '' );
                              ?>

                              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('title')); ?> </span>
                            </div>                      
                        </div>
                    

                        <div class="col-md-4">

                            <?php
                            $post_val = $this->input->post('display_in_menu') ? $this->input->post('display_in_menu') : 0;
                            $post_val = $post_val ? $post_val : (isset($page_data->display_in_menu) && $page_data->display_in_menu ? $page_data->display_in_menu :  0); 
                             ?>

                            <div class="form-group">
                                
                                <label for="display_in_menu" style="clear:both;"><?php echo lang('display_in_menu');?> <?php echo lang('display_in_menu');?><span class="text-danger ml-2">*</span></label>
                                <select name="display_in_menu" class="form-control display_in_menu" id="display_in_menu">
                                    <option value="0"  <?php echo $post_val == 0 ? 'selected' : "";?>><?php echo lang('NO');?> </option>
                                    <option value="1" <?php echo $post_val == 1 ? 'selected' : "";?>> <?php echo lang('YES');?> </option>
                                  
                                </select>
                                
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group <?php echo form_error('featured_image') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('admin_upload_image'), 'featured_image'); ?>

                              <span class="required">*</span>

                              <?php 
                                $populateData = isset($page_data->featured_image) && $page_data->featured_image ? $page_data->featured_image :  ''; 
                              ?> 

                              <input type="file" name="featured_image" id="featured_image" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('featured_image')); ?> </span> 
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
        
                       
                        <div class="col-md-12">

                            <?php
                            $post_val = $this->input->post('content') ? $this->input->post('content') : "";
                            $post_val = $post_val ? $post_val : (isset($page_data->content) && $page_data->content ? $page_data->content :  ""); 
                             ?>

                            <div class="form-group">
                             
                                <label for="content" style="clear:both;"><?php echo lang('content');?><span class="text-danger ml-2">*</span></label>
                                <textarea name="content" class="form-control redactor content"><?php echo $post_val; ?></textarea>
                                    
                            </div>
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-md-12"><hr /></div>

                        <div class="col-12"> 
                            <h2 class="text-center"><?php echo lang('seo_heading');?></h2>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-12"><hr /></div>

                        <div class="col-12">
                            <div class="form-group <?php echo form_error('meta_title') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('meta_title'), 'metatitle'); ?> 
                              <?php 
                                $populateData = $this->input->post('metatitle') ? $this->input->post('metatitle') : (isset($page_data->meta_title) ? $page_data->meta_title :  '' );
                              ?>
                              <input type="text" name="metatitle" id="metatitle" class="form-control" value="<?php echo xss_clean($populateData);?>">
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('metatitle')); ?> </span>
                            </div>
                        </div>
              
                        <div class="col-12">
                            <div class="form-group <?php echo form_error('meta_kewords') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('meta_kewords'), 'metakeywords'); ?>
                              <?php
                                $populateData = $this->input->post('metakeywords') ? $this->input->post('metakeywords') : (isset($page_data->meta_keywords) ? $page_data->meta_keywords :  '' );
                              ?>
                              <input type="text" name="metakeywords" id="metakeywords" class="form-control" value="<?php echo xss_clean($populateData);?>" data-role="tagsinput">
                            </div>
                        </div>    

                        <div class="col-12">
                            <div class="form-group <?php echo form_error('meta_description') ? ' has-error' : ''; ?>">
                              <?php echo  form_label(lang('meta_description'), 'metadescription'); ?>
                              <?php
                                $populateData = $this->input->post('metadescription') ? $this->input->post('metadescription') : (isset($page_data->meta_description) ? $page_data->meta_description :  '' );
                              ?>
                              <textarea name="metadescription" id="metadescription" class="form-control redactor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
                              <span class="small form-error text-danger"> <?php echo strip_tags(form_error('metadescription')); ?> </span>
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