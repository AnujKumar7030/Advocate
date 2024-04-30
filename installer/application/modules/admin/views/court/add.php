<section class="content-header">
    <h1>
        <?php echo lang('court');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/act')?>"><?php echo lang('court');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php 
    if(validation_errors()) {
        ?>
    <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-ban"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                                        </div>

    <?php  } ?>  
           
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/court/add/'); ?>
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
                                 <label for="location_id" ><?php echo lang('location');?></label>
                                    <select name="location_id" class="form-control chzn">
                                    <option value="">--<?php echo lang('select_location');?>--</option>
                                    <?php foreach($locations as $new) {
                                        $sel = "";
                                        echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                    }
                                        
                                    ?>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        
                            <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-4">
                                 <label for="court_category" ><?php echo lang('court');?> <?php echo lang('category');?></label>
                                    <select name="court_category_id" class="form-control chzn">
                                    <option value="">--<?php echo lang('select');?> <?php echo lang('court') ." ". lang('category');?> --</option>
                                    <?php foreach($court_categories as $new) {
                                        $sel = "";
                                        echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                    }
                                        
                                    ?>
                                    </select>
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
                        
                        
                           
                      
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  