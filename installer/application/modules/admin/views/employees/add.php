<section class="content-header">
    <h1>
        <?php echo lang('employees')?>
        <small><?php echo lang('add')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/employees')?>"><?php echo lang('employees')?></a></li>
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
                
                <?php echo form_open_multipart('admin/employees/add/'); ?>
                    <input type="hidden" class="base-url" value="<?php echo base_url(); ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('employee_id')?></label>
                                    <input type="text" name="employee_id" value="<?php echo $e_id?>" class="form-control" disabled="disabled">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('name')?></label>
                                    <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('profile')?> <?php echo lang('picture')?></label>
                                    <input type="file" name="img" value="<?php echo set_value('img')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="gender" ><?php echo lang('gender')?></label>
                                    <input type="radio" name="gender" value="Male" /> <?php echo lang('male')?>
                                    <input type="radio" name="gender" value="Female" /> <?php echo lang('female')?>
                                </div>
                            </div>
                        </div>
               
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="dob" ><?php echo lang('date_of_birth');?></label>
                                    <input type="text" name="dob" autocomplete="off" value="<?php echo set_value('dob')?>" class="form-control datepicker">
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="email" ><?php echo lang('user_role');?></label>
                                    <select name="role_id" class="form-control chzn">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('user_role');?>---</option>
                                        <?php foreach($roles as $new) {
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
                                    <label for="department_id" ><?php echo lang('departments');?></label>
                                    <select name="department_id" class="form-control chzn" id="department_id">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('department');?>---</option>
                                        <?php foreach($departments as $new) {
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
                                    <label for="designation_id" ><?php echo lang('designation');?></label>
                                    <select name="designation_id" class="form-control " id="degi">
                                        <option value="">--<?php echo lang('select');?> <?php echo lang('designation');?>---</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('joining_date')?></label>
                                    <input type="text" name="joining_date" autocomplete="off" value="<?php echo set_value('joining_date')?>" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('joining_salary')?></label>
                                    <input type="text" name="joining_salary" value="<?php echo set_value('joining_salary')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="email" ><?php echo lang('email')?></label>
                                    <input type="text" name="email" value="<?php echo set_value('email')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="username" ><?php echo lang('username')?></label>
                                    <input type="text" name="username" value="<?php echo set_value('username')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="password" ><?php echo lang('password')?></label>
                                    <input type="password" name="password" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="password" ><?php echo lang('confirm')?> <?php echo lang('password')?></label>
                                    <input type="password" name="confirm" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo lang('phone')?></label>
                                    <input type="text" name="contact" value="<?php echo set_value('contact')?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo lang('address')?></label>
                                    <textarea name="address"  class="form-control"><?php echo set_value('address')?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('status')?></label>
                                    <input type="radio" name="status" value="1" /> <?php echo lang('active')?>
                                    <input type="radio" name="status" value="0" /> <?php echo lang('inactive')?>
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
