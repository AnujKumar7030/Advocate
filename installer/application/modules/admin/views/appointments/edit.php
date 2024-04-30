
<section class="content-header">
    <h1>
       <?php echo lang('appointments');?>
        <small><?php echo lang('edit');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/appointments')?>"><?php echo lang('appointments');?></a></li>
        <li class="active"><?php echo lang('edit');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php 
    if(validation_errors()) 
    {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
        </div> <?php  
    } ?>  
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('edit');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            
                <?php echo form_open_multipart('admin/appointments/edit/'.$id); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" > <?php echo lang('title');?></label>
                                    <input type="text" name="title" value="<?php echo $appointment->title;?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('contact');?></label>
                                       <select name="contact_id" class="form-control chzn">
                                            <option value="">--<?php echo lang('select_contact');?>--</option>
                                            <?php foreach($contacts as $new) {
                                                $sel = "";
                                                if($new->id==$appointment->contact_id) { $sel = "selected='selected'";
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
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('motive');?></label>
                                    <textarea name="motive"class="form-control"><?php echo $appointment->motive;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('date');?></label>
                                    <input type="text" name="date_time"class="form-control datetimepicker" value="<?php echo $appointment->date_time;?>">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('notes');?></label>
                                    <textarea name="notes" class="form-control"><?php echo $appointment->notes;?></textarea>
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
                              
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                                            <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."' ")->row();?>        
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
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                                         <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."' ")->row();?>    
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
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                                                     <?php	
                                                                        foreach($values as $key=>$val) { ?>
                                                                            <?php 
                                                                            $x="";
                                                                            $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."' ")->row();
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
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                                                    <?php	
                                                                    foreach($values as $key=>$val) { ?>
                                                                        <?php 
                                                                        $x="";
                                                                        $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."' ")->row();
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
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                        <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."'")->row();?>    
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ><?php echo @$result->reply;?></textarea>
                                </div>
                            </div>
                        </div>
                            
                        
                                            <?php }    if($doc->field_type==6) //url
                                            {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="url" value="<?php echo @$result->reply;?>" class="form-control" name="reply[<?php echo $doc->id ?>]"  />
                                </div>
                            </div>
                        </div>
                    
                                            <?php }    if($doc->field_type==7) //email
                                            {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="email" value="<?php echo @$result->reply;?>" name="reply[<?php echo $doc->id ?>]"  class="form-control" />
                                </div>
                            </div>
                        </div>
                            
                            
                                            <?php }    if($doc->field_type==8) //Phone
                                            {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$id."' AND form = '".$doc->form."'")->row();?>    
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
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  
