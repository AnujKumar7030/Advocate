<section class="content-header">
    <h1>
        <?php echo lang('employees')?>
        <small><?php echo lang('view')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/employees')?>"><?php echo lang('employees')?></a></li>
        <li class="active"><?php echo lang('view')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('view')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('employee_id')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->employee_id?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('name')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->name?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('profile')?> <?php echo lang('picture')?></label>
                                    
                                <br />

                                 <?php 
                                    if(!empty($employee->image)) {
                                        ?>
                                 <img src="<?php echo base_url('assets/uploads/images/'.$employee->image);?>" height="90" width="110" />
                                        <?php 
                                    }
                                    ?>    
                                 </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="gender" ><?php echo lang('gender')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->gender?>
                                </div>
                            </div>
                        </div>
               
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="dob" ><?php echo lang('date_of_birth')?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo date_convert($employee->dob)?>
                                    
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="dob" ><?php echo lang('user_role')?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo $employee->role?>
                                    
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('department')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php foreach($departments as $new) {
                                        if($new->id==$employee->department_id) { echo $new->name;
                                        }
                                    }
                                    ?>    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('designation')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php foreach($designations as $new) {
                                        if($new->id==$employee->designation_id) { echo $new->designation;
                                        }
                                    }
                                        
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('joining_date')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo date_convert($employee->joining_date)?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('joining_salary')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->joining_salary?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="email" ><?php echo lang('email')?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo $employee->email?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="username" ><?php echo lang('username')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->username?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo lang('phone')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->contact?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo lang('address')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo $employee->address?>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo lang('status')?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php echo ($employee->status==1)?lang('active'):lang('inactive');?>
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
                              
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."' ")->row();?>        
                                                                    <?php echo @$result->reply; ?>
                                </div>
                            </div>
                        </div>
                                        <?php     }    
                                        if($doc->field_type==2) //dropdown list
                                        {
                                                        $values = explode(",", $doc->values);
                                            ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                
                                                                 <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."'  ")->row();?>    
                                                                 <?php	    if(!empty($values)) {
                                                                        foreach($values as $key=>$val) {
                                                                            ///$val='';
                                                                            if($val==$result->reply) { echo $val;
                                                                            }
                                                                        }
                                                                 }
                                                                    ?>            
                                </div>
                            </div>
                        </div>
                                        <?php	}    
                                        if($doc->field_type==3) //radio buttons
                                        {
                                                   $values = explode(",", $doc->values);
                                            ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            </div>    
                                <div class="col-md-4">
                                                                          <?php	
                                                                            foreach($values as $key=>$val) { ?>
                                                                                <?php 
                                                                                $x="";
                                                                                $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."' ")->row();
                                                                                if(!empty($result->reply)) {
                                                                                    if($result->reply==$val) {
                                                                                        $x= $val;
                                                                                    }else{
                                                                                        $x='';
                                                                                    }
                                                                                }
                                                                                ?>            
                        
                                                                                <?php echo $x;?>
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
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            </div>    
                                <div class="col-md-4">
                                                                       <?php	
                                                                        foreach($values as $key=>$val) { ?>
                                                                            <?php 
                                                                            $x="";
                                                                            $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."' ")->row();
                                                                            if(!empty($result->reply)) {
                                                                                if($result->reply==$val) {
                                                                                    $x= $val;
                                                                                }else{
                                                                                    $x='';
                                                                                }
                                                                            }
                                                                            ?>    
                                        
                                                                            <?php echo $x;?>
                                                                        <?php } ?>            
                                </div>
                            </div>
                        </div>
                                        <?php }    if($doc->field_type==5) //Textarea
                                        {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."'")->row();?>    
                                            <?php echo @$result->reply;?>
                                </div>
                            </div>
                        </div>
                    
                    
                                        <?php }    if($doc->field_type==6) //URl
                                         {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                             <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."'")->row();?>    
                                        <a href="<?php echo @$result->reply;?>" target="_blank"> <?php echo @$result->reply;?></a>
                                </div>
                            </div>
                        </div>
                        
                                        <?php }    if($doc->field_type==7) //EMAIL
                                         {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                             <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."'")->row();?>    
                                        <a href="mailto:<?php echo @$result->reply;?>" target="_top"> <?php echo @$result->reply;?></a>
                                </div>
                            </div>
                        </div>                
                    
                                        <?php }    if($doc->field_type==8) //Phone
                                         {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                             <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$employee->id."' AND form = '".$doc->form."'")->row();?>    
                                             <?php echo @$result->reply;?>
                                </div>
                            </div>
                        </div>    
                        
                        
                                             <?php 
                                        }    
                                    }
                                }
                                ?>                    

                    </div><!-- /.box-body -->
    
                   
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>