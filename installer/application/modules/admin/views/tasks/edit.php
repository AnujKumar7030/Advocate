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
        <small><?php echo lang('edit')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/tasks')?>"><?php echo lang('tasks')?></a></li>
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
                                            <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
    </div>

    <?php  } ?>
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('edit')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/tasks/edit/'.$id.'?'.$my_tasks); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" ><?php echo lang('name')?></label>
                                    <input type="text" name="name" value="<?php echo $task->name?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="email" ><?php echo lang('priority');?></label>
                                    <select name="priority" class="form-control chzn">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('priority');?>---</option>
                                        <option value="1" <?php echo ($task->priority==1)?'selected="selected"':'';?> >Low</option>
                                        <option value="2" <?php echo ($task->priority==2)?'selected="selected"':'';?>>Medium</option>
                                        <option value="3" <?php echo ($task->priority==3)?'selected="selected"':'';?>>High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="dob" ><?php echo lang('due_date');?></label>
                                    <input type="text" name="due_date" autocomplete="off" value="<?php echo $task->due_date?>" class="form-control datepicker">
                                    
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
                                            if($task->case_id== $new->id) { $sel = "selected='selected'";
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
                                        <?php 
                                        foreach($assigned_users as $new){
                                            $users[] = $new->user_id;
                                        }
                                        
                                        foreach($employees as $new) {
                                            $sel = "";
                                            
                                            $sel = (in_array($new->id, $users))?'selected="selected"': '';
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
                                              
                                               data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $task->progress?>"/
                                              
                                              data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                                        </div>
                                      
                                    </div>
                     </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="email" ><?php echo lang('description');?></label>
                                    <textarea name="description" class="form-control redactor"><?php echo set_value('description')?><?php echo $task->description?></textarea>
                                    </div>
                            </div>
                        </div>
                        
                        <?php 
                        $CI = get_instance();
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
                                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."' ")->row();?>        
                            <input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" value="<?php echo @$result->reply; ?>"/>
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
                                                 <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."' ")->row();?>    
                            <select name="reply[<?php echo $doc->id ?>]" class="form-control">
                                                 <?php	
                                                    foreach($values as $key=>$val) {
                                                        $sel='';
                                                        if($val==$result->reply) { $sel = "selected='selected'";
                                                        }
                                                        echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
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
                                                        <?php 
                                                        $x="";
                                                        $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."' ")->row();
                                                        if(!empty($result->reply)) {
                                                            if($result->reply==$val) {
                                                                $x= 'checked="checked"';
                                                            }else{
                                                                $x='';
                                                            }
                                                        }
                                                        ?>            
                        
                        <input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" <?php echo $x;?> />    <?php echo $val;?> &nbsp; &nbsp; &nbsp; &nbsp;
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
                                                    <?php 
                                                    $x="";
                                                    $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."' ")->row();
                                                    if(!empty($result->reply)) {
                                                        if($result->reply==$val) {
                                                            $x= 'checked="checked"';
                                                        }else{
                                                            $x='';
                                                        }
                                                    }
                                                    ?>    
                                        
                                        <input type="checkbox" name="reply[<?php echo $doc->id ?>]"  <?php echo $x;?> value="<?php echo $val;?>" class="form-control" />    &nbsp; &nbsp; &nbsp; &nbsp;
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
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."'")->row();?>    
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ><?php echo @$result->reply;?></textarea>
                                </div>
                            </div>
                        </div>
                            
                                <?php }    if($doc->field_type==6) //url
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="url" value="<?php echo @$result->reply;?>" class="form-control" name="reply[<?php echo $doc->id ?>]"  />
                                </div>
                            </div>
                        </div>
                    
                                <?php }    if($doc->field_type==7) //email
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="email" value="<?php echo @$result->reply;?>" name="reply[<?php echo $doc->id ?>]"  class="form-control" />
                                </div>
                            </div>
                        </div>
                            
                            
                                <?php }    if($doc->field_type==8) //Phone
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$task->id."' AND form = '".$doc->form."'")->row();?>    
                                    <input type="number" value="<?php echo @$result->reply;?>" class="form-control" name="reply[<?php echo $doc->id ?>]" />
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
