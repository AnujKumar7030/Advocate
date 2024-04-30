<section class="content-header">
    <h1>
        <?php echo lang('notice');?>
        <small><?php echo lang('view');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/notice')?>"><?php echo lang('notice');?></a></li>
        <li class="active"><?php echo lang('view');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('view');?></h3>
                </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" > <?php echo lang('title');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo $notice->title; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('description');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo $notice->description; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('date');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo date_time_convert($notice->date_time); ?>
                                </div>
                            </div>
                        </div>
                        
                           
                         
                    </div><!-- /.box-body -->
    
                  
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  