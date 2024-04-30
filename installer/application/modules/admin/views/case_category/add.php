<section class="content-header">
    <h1>
        <?php echo lang('case');?> <?php echo lang('category');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/case_category')?>"><?php echo lang('case');?> <?php echo lang('category');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php 
        if(validation_errors()) 
        {
            ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                    <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                </div>
            <?php  
        } ?>  
       
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/case_category/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" ><?php echo lang('category_name');?> </label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        
                           
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="email" ><?php echo lang('parent');?> <?php echo lang('category');?></label>
                                    <select name="parent_id" class="form-control chzn">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('parent');?> <?php echo lang('category');?>---</option>
                                        <?php foreach($categories as $new) {
                                            $sel = "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        


                        <?php
                        $post_val = $this->input->post('display_in_menu') ? $this->input->post('display_in_menu') : "";
                         ?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="display_in_menu" style="clear:both;"><?php echo lang('display_in_menu');?> <?php echo lang('display_in_menu');?><span class="text-danger ml-2">*</span></label>
                                    <select name="display_in_menu" class="form-control display_in_menu" id="display_in_menu">
                                        <option value="NO"  <?php echo $post_val == 'NO' ? 'selected' : "";?>><?php echo lang('NO');?> </option>
                                        <option value="YES" <?php echo $post_val == 'YES' ? 'selected' : "";?>> <?php echo lang('YES');?> </option>
                                      
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                          <div class="row">
                                <div class="col-md-6">
                                    <label for="description" style="clear:both;"><?php echo lang('description');?><span class="text-danger ml-2">*</span></label>
                                    <textarea name="description" class="form-control redactor description"><?php echo set_value('description')?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
    </div>
</section> 