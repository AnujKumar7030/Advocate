<section class="content-header">
    <h1>
        <?php echo lang('notes')?>
        <small><?php echo $case->title?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('case')?></a></li>
        <li class="active"><?php echo lang('edit')?></li>
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
            <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
        </div>

    <?php  } ?>
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                  <?php echo form_open_multipart('admin/cases/notes/'.$id); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes')?></b>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <textarea name="notes" class="form-control redactor"><?php echo $case->notes;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                           
                         
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('update')?></button>
                    </div>
             <?php echo form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>