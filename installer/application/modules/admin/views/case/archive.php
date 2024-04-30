<section class="content-header">
    <h1>
        <?php echo lang('archived');?>
        <small><?php echo lang('case');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>">Case</a></li>
        <li class="active"><?php echo lang('archive');?> <?php echo lang('case');?></li>
    </ol>
</section>

<section class="content">


    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('archive');?> <?php echo lang('case');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
        <?php if(validation_errors()) { ?>        
            <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                    </div>
        <?php } ?>                            
                <?php echo form_open_multipart('admin/cases/archived/'.$id); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-1">
                                    <b><?php echo lang('case');?> <?php echo lang('title');?></b>
                                </div>
                                <div class="col-md-2">
                                    
                                    <?php echo $case->title;?>
                                </div>
                                
                                 <div class="col-md-1">
                                    <b><?php echo lang('case');?> <?php echo lang('number');?></b>
                                </div>
                                <div class="col-md-2">
                                    
                                    <?php echo $case->case_no;?>
                                </div>
                                
                                 <div class="col-md-1">
                                    <b><?php echo lang('client');?></b>
                                </div>
                                <div class="col-md-2">
                                        <?php foreach($clients as $new) {
                                            $sel = "";
                                            if($new->id==$case->client_id) { echo $new->name;
                                            }
                                        }
                                            
                                        ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes');?></b>
                                </div>
                                <div class="col-md-4">
                                   <textarea name="notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('close');?> <?php echo lang('date');?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="close_date" value="" class="form-control datepicker"/>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('close');?></button>
                    </div>
             <?php echo form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  
