<style>
    .add-btn
    {
        border:solid 1px #000000;
        padding:4px 10px;
        color:#000000;
    }
</style>



<section class="content-header">
    <h1>
        <?php echo lang('tasks')?>
        <small><?php echo lang('add')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/tasks')?>"><?php echo lang('tasks')?></a></li>
        <li class="active"><?php echo lang('add')?></li>
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
                    <h3 class="box-title"><?php echo lang('add')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/tasks/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" ><?php echo lang('name')?></label>
                                    <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="email" ><?php echo lang('priority');?></label>
                                    <select name="priority" class="form-control chzn">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('priority');?>---</option>
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="2">High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="dob" ><?php echo lang('due_date');?></label>
                                    <input type="text" name="due_date" autocomplete="off" value="<?php echo set_value('due_date')?>" class="form-control datepicker">
                                    
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="case_id" ><?php echo lang('case');?></label>
                                    <select name="case_id" class="form-control chzn">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('case');?>---</option>
                                        <?php foreach($cases as $new) {
                                            $sel = "";
                                            if(set_select('case_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>#'.$new->case_no.'-'.$new->title.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-5">
                                    <a href="<?php echo base_url('admin/cases/add'); ?>" class="add-btn">Add</a>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="employee_id" ><?php echo lang('assigned_to');?></label>
                                    <select name="employee_id[]" class="form-control chzn" multiple="multiple" data-placeholder="<?php echo lang('select');?> <?php echo lang('employees');?>">
                                        <?php foreach($employees as $new) {
                                            $sel = "";
                                            if(set_select('employee_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-5">
                                    <a href="<?php echo base_url('admin/employees/add'); ?>" class="add-btn">Add</a>
                                </div>
                            </div>
                        </div>
                    
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="progress" ><?php echo lang('progress');?></label>
                        
                                              <input type="text" value=""  name="progress" class="slider form-control" 
                                              
                                               data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo set_value('description')?set_value('description'):0;?>"/
                                              
                                              data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                                        </div>
                                      
                                    </div>
                     </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="email" ><?php echo lang('description');?></label>
                                    <textarea name="description" class="form-control redactor"><?php echo set_value('description')?></textarea>
                                    </div>
                            </div>
                        </div>
                        
                        
                        <?php 
                        if($fields) {
                            foreach($fields as $doc){
                                $output = '';
                                if($doc->field_type==1) //testbox
                                {
                                    ?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            <input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" id="req_doc" />
                                </div>
                            </div>
                        </div>
                                <?php     }    
                                if($doc->field_type==2) //dropdown list
                                {
                                        $values = explode(",", $doc->values);
                                    ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            <select name="reply[<?php echo $doc->id ?>]" class="form-control">
                                                 <?php	
                                                    foreach($values as $key=>$val) {
                                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                                    }
                                                    ?>            
                            </select>    
                                </div>
                            </div>
                        </div>
                                <?php	}    
                                if($doc->field_type==3) //radio buttons
                                {
                                                  $values = explode(",", $doc->values);
                                    ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                                  <?php	
                                                    foreach($values as $key=>$val) { ?>
                                        
                                        <input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" />    <?php echo $val;?> &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <?php             }
                                                    ?>            
                                </div>
                            </div>
                        </div>
                        
                                <?php }
                                if($doc->field_type==4) //checkbox
                                {
                                               $values = explode(",", $doc->values);
                                    ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                               <?php	
                                                foreach($values as $key=>$val) { ?>
                                        
                                        <input type="checkbox" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" class="form-control" />    &nbsp; &nbsp; &nbsp; &nbsp;
                                                <?php             }
                                                ?>            
                                </div>
                            </div>
                        </div>
                                <?php }    if($doc->field_type==5) //Textarea
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ></textarea        
                                ></div>
                            </div>
                        </div>
                            
                        
                        
                                    <?php 
                                }    if($doc->field_type==6) //url
                                  {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="url"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                            
                                                                   <?php 
                                }    if($doc->field_type==7) //Email
                                  {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="email"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                                    
                                                             <?php 
                                }    if($doc->field_type==8) //Phone
                                  {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="number"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                                                    
                        
                        
                                                                <?php	 
                                }    
                            }
                        }
                        ?>    
                        

                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  
