<section class="content-header">
    <h1>
        <?php echo lang('documents Types');?>

        <?php $action = $id ? lang('edit') : lang('add'); ?>


        <small><?php echo $action;?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/documents/types')?>"><?php echo lang('Documents Types');?></a></li>
        <li class="active"><?php echo $action;?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $action;?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart(); ?>
                    <div class="box-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    $value = $this->input->post('name') ? $this->input->post('name') : ( isset($DataObj->name) && $DataObj->name ? $DataObj->name : "");
                                 ?>
                                
                                <div class="form-group <?php echo form_error('name') ? ' has-error border-danger border' : ''; ?>">
                                    <label for="name" > <?php echo lang('Name');?></label><span class="text-danger">*</span>
                                    <input type="text" required name="name" value="<?php echo $value; ?>" class="form-control name" id="name" />
                                    <span class="small form-error text-danger"> <?php echo strip_tags(form_error('name')); ?> </span>
                                </div>
                            </div>
                                
                            <div class="col-md-6">
                                <?php
                                    $value = $this->input->post('color') ? $this->input->post('color') : ( isset($DataObj->color) && $DataObj->color ? $DataObj->color : "");
                                 ?>
                                
                                <div class="form-group <?php echo form_error('color') ? ' has-error' : ''; ?>">
                                    <label for="color" > <?php echo lang('Color');?></label><span class="text-danger">*</span>
                                    <input type="color" required name="color" value="<?php echo $value; ?>" class="form-control name" id="color" />
                                    <span class="small form-error text-danger"> <?php echo strip_tags(form_error('color')); ?> </span>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
                        
                    <?php $action = $id ? lang('update') : lang('Save'); ?>
                    <div class="box-footer">
                        <button type="submit" name="action" value="" class="btn btn-primary"><?php echo $action; ?></button>
                    </div>

             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section> 