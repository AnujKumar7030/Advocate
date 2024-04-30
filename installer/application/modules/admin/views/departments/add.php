<section class="content-header">
    <h1>
        <?php echo lang('departments');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/departments')?>"><?php echo lang('departments');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <h3 class="text-white-ff"><?php echo validation_errors(); ?></h3>
                <?php echo form_open_multipart('admin/departments/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" > <?php echo lang('name');?></label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('description');?></label>
                                    <textarea name="description"class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                            <div class="form-group input_fields_wrap">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name" > <?php echo lang('designations');?></label>
                                            <input type="text" name="designations[]" value="" class="form-control" placeholder="<?php echo lang('designations');?>">
                                        </div>
                                        
                                        <div class="col-md-4 pt-22" >
                                            <button type="button" class="add_field_button btn btn-success" >Add More </button>
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
