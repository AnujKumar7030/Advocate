<section class="content-header">
    <h1>
       <?php echo lang('detail');?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('case');?></a></li>
        <li class="active"><?php echo lang('extended_dates');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               
                <!-- form start -->
                <h6 class="text-white-ff"><?php echo validation_errors(); ?></h3>
                <form method="post" action="<?php echo site_url('admin/cases/dates/'.$id)?>" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('next');?> <?php echo lang('date');?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <?php echo $cases->next_date;?>
                                </div>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('last');?> <?php echo lang('date');?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <?php echo $cases->last_date;?>
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes');?></b>
                                </div>
                                <div class="col-md-4">
                               <?php echo $cases->note;?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('attachment');?> <?php echo lang('document');?></b>
                                </div>
                                <div class="col-md-4">
                                   <?php if(!empty($cases->document)) {?>
                                          <a class="btn btn-default" download href="<?php echo site_url('assets/uploads/files/'.$cases->document); ?>" target="_blank"><i class="fa fa-download"></i> Attachment</a>                    
                                   <?php }else {?>
                                       <?php echo lang('no');?> <?php echo lang('attachment');?>
                                   <?php } ?>  
                                </div>
                            </div>
                        </div>
                   </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary" onclick="window.history.back();"><?php echo lang('go_back');?></button>
                    </div>
                    
                </div><!-- /.box-body -->
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section>  