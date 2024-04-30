<section class="content-header">
    <h1>
        <?php echo lang('documents');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/documents')?>"><?php echo lang('documents');?></a></li>
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
                <?php echo form_open_multipart('admin/documents/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" > <?php echo lang('type');?></label>
                                    <select class="form-control" name="is_case" id="is_case">
                                        <option value="1"><?php echo lang('case')?></option>
                                        <option value="0"><?php echo lang('other')?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group" id="case">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('case');?></label>
                                <select class="form-control chzn" name="case_id">
                                    <option value=""><?php echo lang('select')?> <?php echo lang('case')?></option>
                                    <?php 
                                    foreach($cases as $new){
                                        
                                        echo '<option value='.$new->id.'>'.$new->case_no.' '.$new->title.'</option>';
                                    }    
                                    ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="form-group" id="title">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('title');?></label>
                                    <input type="text" name="title" value="" class="form-control" />
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