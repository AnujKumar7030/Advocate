<section class="content-header">
    <h1>
        <?php echo lang('documents');?>
        <small><?php echo lang('edit');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/documents')?>"><?php echo lang('documents');?></a></li>
        <li class="active"><?php echo lang('edit');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('edit');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <h3 class="text-white-ff" ><?php echo validation_errors(); ?></h3>
                <?php echo form_open_multipart('admin/documents/edit/'.$id); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" > <?php echo lang('type');?></label>
                                    <select class="form-control" name="is_case" id="is_case">
                                        <option value="1" <?php echo ($document->is_case==1)?'selected="selected"':'';?>><?php echo lang('case')?></option>
                                        <option value="0" <?php echo ($document->is_case==0)?'selected="selected"':'';?>><?php echo lang('other')?></option>
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
                                        $sel = '';
                                        if($new->id==$document->case_id) { $sel = 'selected="selected"';
                                        }
                                        echo '<option value='.$new->id.' '.$sel.'>'.$new->case_no.' '.$new->title.'</option>';
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
                                    <input type="text" name="title" value="<?php echo $document->title?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('update');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section> 