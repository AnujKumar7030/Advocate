<section class="content-header">
    <h1>
        <?php echo lang('case_study');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/case_study')?>"><?php echo lang('case_study');?></a></li>
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
                <?php echo form_open_multipart('admin/case_study/add/'); ?>
                    <div class="box-body">
                    
                      <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" > <?php echo lang('title');?></label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="title" value="<?php echo set_value('title')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?>  <?php echo lang('category')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="case_category_id[]" class="chzn form-control" multiple="multiple" data-placeholder="Select Case Categories" >
                                        <?php foreach($case_categories as $new) {
                                            $sel = "";
                                            if(set_select('case_category_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes')?> </b>
                                </div>
                                <div class="col-md-8">
                                   <textarea name="notes" class="form-control redactor"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('result')?> </b>
                                </div>
                                <div class="col-md-8">
                                   <textarea name="result" class="form-control redactor"></textarea>
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